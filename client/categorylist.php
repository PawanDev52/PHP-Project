<div>
  <h1 class="text-center">Categories</h1>
  <?php
  include('./common/db.php');

  $query = "select * from category";
  $result = $conn->query($query);
  foreach ($result as $row) {
    $name = ucfirst($row['name']);
    $id = $row['id'];
    echo "<div class='m-2 p-3 question-list'>
    <h4 class='m-0 p-0'><a href='?q-id=$id'>$name</a></h4>
    </div>";
  }
  ?>
</div>