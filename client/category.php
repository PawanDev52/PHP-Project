<select class="form-control" name="category" id="category">
  <option value="">Select a category</option>
  <?php
    include("./common/db.php");

    $query = "select * from category";
    $result = $conn->query($query);

    foreach ($result as $row) {
        $id = $row['id'];
        $name = ucfirst($row['name']);
        echo "<option value=$id>$name</option>";
    }
  ?>
</select>