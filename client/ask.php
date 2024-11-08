<div class="container">
  <h1 class="text-center mb-3">Ask a Question</h1>
  <form action="./server/requests.php" method="post">
    <div class="col-6 offset-sm-3 mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" name="title" class="form-control" id="title" placeholder="Enter question">
    </div>

    <div class="col-6 offset-sm-3 mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea name="description" class="form-control" id="description" placeholder="Enter description"></textarea>
    </div>

    <div class="col-6 offset-sm-3 mb-3">
      <label for="category" class="form-label">Category</label>
      <select name="category" id="category" class="form-control">
        <option value="">Mobiles</option>
        <option value="">General</option>
        <option value="">Coding</option>
      </select>
    </div>

    <div class="col-6 offset-sm-3">
      <button type="submit" name="login" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>