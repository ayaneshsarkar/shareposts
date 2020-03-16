<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-outline-dark">
  <span><i class="fa fa-backward"></i></span> Back
</a>
<br><br>
<h1 class="mb-2"><?php echo $data['post']->title ?></h1>
<div class="bg-secondary text-white p-2 mb-2">
Written By <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?>
</div>
<p class="lead"><?php echo $data['post']->body; ?></p>

<?php if($data['post']->user_id == $_SESSION['user_id']) : ?>
  <hr>
  <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Edit</a>

  <form class="float-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
    <input type="submit" value="Delete" class="btn btn-danger">
  </form>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>