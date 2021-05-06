<?php $validation = \Config\Services::validation(); ?>

<form method="post" action="<?php echo base_url('/form/validate'); ?>">
  <div class="form-group">
    <label>Username</label>
    <input type="text" name="name" class="form-control">

    <!-- Error -->
    <?php if ($validation->getError('name')) { ?>
      <div class='alert alert-danger mt-2'>
        <?= $error = $validation->getError('name'); ?>
      </div>
    <?php } ?>
  </div>


  <div class="form-group">
    <label>Email</label>
    <input type="text" name="email" class="form-control">

    <!-- Error -->
    <?php if ($validation->getError('email')) { ?>
      <div class='alert alert-danger mt-2'>
        <?= $error = $validation->getError('email'); ?>
      </div>
    <?php } ?>
  </div>

  <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control">

    <!-- Error -->
    <?php if ($validation->getError('password')) { ?>
      <div class='alert alert-danger mt-2'>
        <?= $error = $validation->getError('password'); ?>
      </div>
    <?php } ?>
  </div>

  <div class="form-group">
    <button type="submit" class="btn btn-primary btn-block">Submit</button>
  </div>
</form>