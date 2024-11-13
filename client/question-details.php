<div class="container">
  <h1 class="text-center">Questions</h1>
  <?php
  include("./common/db.php");
  $query = "select * from questions where id = $qid";
  $result = $conn->query($query);
  $row = $result->fetch_assoc();
  print_r($row);
  ?>
</div>