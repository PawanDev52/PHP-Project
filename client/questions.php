<div class="container">
  <h1 class="text-center">Questions</h1>
  <div class="col-8">
  <?php
  include("./common/db.php");
  $query = "select * from questions";
  $result = $conn->query($query);
  foreach($result as $row){
    $title = $row['title'];
    echo "<div class='m-2 p-3 question-list'>
    <h4 class='m-0 p-0'><a href='#'>$title</a></h4>
    </div>";

  }
  ?>
  </div>
</div>