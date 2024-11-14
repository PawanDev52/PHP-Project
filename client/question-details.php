<div class="container">
  <h1 class="text-center">Questions</h1>
  <div class="col-8">
  <?php
  include("./common/db.php");
  $query = "select * from questions where id = $qid";
  $result = $conn->query($query);
  $row = $result->fetch_assoc();
  
  echo "<h4 class='mb-3 qsn-dtl'> Question : " . $row['title'] . "</h4>
  <p class='mb-3'>" . $row['description'] . "</p>";
  ?>
  
  <form action="./server/requests.php" method="post">
    <input type="hidden" name="question_id" value="<?php echo $qid ?>">
    <textarea name="answer" class="form-control mb-3" placeholder="Your answer ...."></textarea>
    <button class="btn btn-primary">Write your answer</button>
  </form>
  </div>
</div>