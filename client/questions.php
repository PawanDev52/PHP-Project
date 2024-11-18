<div class="container">
  <div class="row">
    <div class="col-8">
    <h1 class="text-center">Questions</h1>
      <?php
      include("./common/db.php");
      if(isset($_GET['c-id'])){
        $query = "select * from questions where category_id=$cid";
      } else if(isset($_GET['u-id'])){
        $query = "select * from questions where user_id=$uid";
      } else{
        $query = "select * from questions";
      }
      
      $result = $conn->query($query);
      foreach ($result as $row) {
        $title = $row['title'];
        $qtitle = ucfirst($title);
        $id = $row['id'];
        echo "<div class='m-2 p-3 question-list'>
        <h4 class='m-0 p-0'><a href='?q-id=$id'>$qtitle</a></h4>
        </div>";
      }
      ?>
    </div>
    <div class="col-4">
      <?php include('categorylist.php') ?>
    </div>
  </div>
</div>