<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Adapter\Repository\PageRepository;
use App\UseCase\GetAllPageUseCase;
use App\Infrastructure\Dao\PageDao;
session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=memo; charset=utf8',
    $dbUserName,
    $dbPassword
);

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$pageAllRepository = new PageRepository(new PageDao($pdo));
$getAllUseCase = new GetAllPageUseCase($pageAllRepository);
if (!empty($keyword)) {
    $pages = $getAllUseCase->searchAllPage($keyword);
}
if(empty($keyword)) {
    $pages = $getAllUseCase->readAllPage();
}

$date_format = 'Y年m月d日H時i分s秒';

foreach ($pages as $key => $value) {
    $standard_key_array[$key] = $value['created_at'];
}
array_multisort($standard_key_array, SORT_DESC, $pages);

?>

<head>
  <link href="https://use.fontawesome.com/releases/v6.5.2/css/all.css" rel="stylesheet">
</head>
<body>

  <div>
    <form method="GET">
      <input type="text" name="keyword" placeholder="Search..." value="<?php echo $keyword ?>">
      <button type="submit" name="search">検索</button>
    </form>
  </div>

  <div>
    <a href="./create.php">メモを追加</a><br>
  </div>

  <div>
    <?php foreach ($errors as $error): ?>
      <p><?php echo $error; ?></p>
    <?php endforeach; ?>
  </div>

  <div>
    <table border="1">
      <tr>
        <th>タイトル</th>
        <th>内容</th>
        <th>作成日時</th>
        <th>マーク</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
      <?php foreach ($pages as $page): ?>
        <tr>
          <td><?php echo $page['title']; ?></td>
          <td><?php echo $page['content']; ?></td>
          <td><?php echo date($date_format, strtotime($page['created_at'])); ?></td>
          <td style="text-align: center;">
              <form action="./toggle.php" method="post" style="margin-top: 50%;">
                  <button type="submit">
                    <?php if ($page['status'] == 1): ?>
                        <i class="fa-solid fa-fire" style="color: red;"></i>
                    <?php endif; ?>
                    <?php if ($page['status'] == 0): ?>
                        <i class="fa-solid fa-fire" style="color: pink;"></i>
                    <?php endif; ?>
                    <input type="hidden" name="page_id" value="<?php echo $page['id']; ?>">
                    <input type="hidden" name="status" value="<?php echo $page['status'] == 1 ? 0 : 1; ?>">
                  </button>
              </form>
          </td>
          <td><a href="./edit.php?id=<?php echo $page['id']; ?>">編集</a></td>
          <td><a href="./delete.php?id=<?php echo $page['id']; ?>">削除</a></td>
        </tr>
      <?php endforeach; ?>

    </table>
  </div>

</body>