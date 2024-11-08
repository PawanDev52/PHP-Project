<div class="container">
  <h1 class="text-center mb-3">Ask a Question</h1>
  <form action="./server/requests.php" method="post">
    <div class="col-6 offset-sm-3 mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" name="title" class="form-control" id="title" placeholder="Enter question">
    </div>
    <div class="col-6 offset-sm-3">
      <button type="submit" name="login" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>