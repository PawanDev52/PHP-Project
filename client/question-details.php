<div class="container">
  <h1 class="text-center">Questions</h1>
  <div class="row">
    <div class="col-8">
      <?php
      include("./common/db.php");
      $query = "select * from questions where id = $qid";
      $result = $conn->query($query);
      $row = $result->fetch_assoc();
      $cid = $row['category_id'];
      $qt = ucfirst($row['title']);

      echo "<h4 class='mb-3 qsn-dtl'> Question : " . $qt . "</h4>
      <p class='mb-3'>" . $row['description'] . "</p>";
      include('answers.php');
      ?>

      <form action="./server/requests.php" method="post">
        <input type="hidden" name="question_id" value="<?php echo $qid ?>">
        <textarea name="answer" class="form-control mb-3" placeholder="Your answer ...."></textarea>
        <button class="btn btn-primary">Write your answer</button>
      </form>
    </div>
    <div class="col-4">
      <?php
      $categoryQuery = "select name from category where id=$cid";
      $categoryResult = $conn->query($categoryQuery);
      $categoryRow = $categoryResult->fetch_assoc();
      
      echo "<h3 class='text-center'> " . ucfirst($categoryRow['name']) . ": related questions</h3>";

      $query = "select * from questions where category_id=$cid and id!=$qid";
      $result = $conn->query($query);
      foreach($result as $row){
        $id = $row['id'];
        $title = ucfirst($row['title']);
        echo "<div class='m-2 p-2 category-list'>
        <h4><a href=?q-id=$id>$title</a></h4>
        </div>";
      }

      ?>
    </div>
  </div>
</div>