<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Adapter\Repository\FavoriteRepository;
use App\Infrastructure\Redirect\Redirect;
use App\Domain\ValueObject\Page_favorite\PageId;
use App\Domain\ValueObject\Page_favorite\Status;
use App\UseCase\UseCaseInput\CreateFavoriteInput;
use App\UseCase\UseCaseInput\EditFavoriteInput;
use App\UseCase\UseCaseInteractor\CreateFavoriteInteractor;
use App\UseCase\UseCaseInteractor\EditFavoriteInteractor;
use App\Infrastructure\Dao\FavoriteDao;
use App\UseCase\GetStatusPageUseCase;
use App\Adapter\Favorite\FavoriteMysqlCommand;
use App\Adapter\Favorite\FavoriteMysqlQuery;

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=memo; charset=utf8',
    $dbUserName,
    $dbPassword
);

$id = filter_input(INPUT_POST, 'page_id');
$statusValue = $_POST['status'];

try {
    session_start();
    $pege_id = new PageId($id);
    $status = new Status($statusValue);

    $favoriteRepository = new FavoriteRepository(new FavoriteDao($pdo));
    $getPageId = new GetStatusPageUseCase($favoriteRepository);
    $checkPageId = $getPageId->getPageId($id);

    $favoriteMysqlQuery = new FavoriteMysqlQuery();
    $favoriteMysqlCommand = new FavoriteMysqlCommand();

    if($checkPageId) {
        $useCaseInput = new EditFavoriteInput($pege_id, $status);
        $useCase = new EditFavoriteInteractor($useCaseInput);
    }
    if(!$checkPageId) {
        $useCaseInput = new CreateFavoriteInput($pege_id, $status);
        $useCase = new CreateFavoriteInteractor($useCaseInput, $favoriteMysqlQuery, $favoriteMysqlCommand);
    }
    $useCaseOutput = $useCase->handler();
    if(!$useCaseOutput->isSuccess()) {
        throw new Exception($useCaseOutput->message());
    }
    $_SESSION['message'] = $useCaseOutput->message();
    Redirect::handler('/index.php');
} catch(Exception $e) {
    $_SESSION['errors'][] = $e->getMessage();
    $_SESSION['page_favorites']['status'] = $status;
    Redirect::handler('/index.php');
}
