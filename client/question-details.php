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

  <textarea class="form-control mb-3" placeholder="Write your answer"></textarea>
  <button class="btn btn-primary">Submit</button>
  </div>
</div>