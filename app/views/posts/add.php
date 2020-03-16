<?php require APPROOT . '/views/inc/header.php'; ?>
  <a href="<?php echo URLROOT; ?>/posts" class="btn btn-outline-dark"><span><i class="fa fa-backward"></i></span> Back</a>

  <div class="card mt-3">
    <div class="card-body">
      <h2>Add Post</h2>
      <p class="lead">Create a Post with this form...</p>

      <form action="<?php echo URLROOT; ?>/posts/add" method="post">
        <div class="form-group">
          <label for="title">Title: <sup>*</sup></label>
          <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
          <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
        </div>

        <div class="form-group">
          <label for="body">Body: <sup>*</sup></label>
          <textarea rows="5" name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
          <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
        </div>

        <input type="submit" value="Submit" class="btn btn-success">
      </form>
    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>