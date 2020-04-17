<?php

global $base_url;

?>
<div class="employee-wrapper">
  <div class="row">
    <a class="button" href="<?= $base_url . '/product/' . $result['id'] . '/edit' ?>">Edit Product</a>
  </div>
  <div class="row">
    <br>
    <div class="column">
      <div class="row">
        <span class="label">Title: </span>
        <span><b><?= htmlentities($result['title']) ?> </b></span>
      </div>
      <div class="row">
        <span class="label"> Summary: </span>
        <span><b> <?= htmlentities($result['summary']) ?> </b></span>
      </div>
      <div class="row">
        <span class="label">Description: </span>
        <span><b><?= $result['description']; ?></b></span>
      </div>
      <div class="row">
        <span class="label">Category: </span>
        <?php foreach (explode(',', $result['category']) as $category) : ?>
          <span><b><?= htmlentities($category) ?></b></span>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="row">
      <span class="label">Type: </span>
      <span><b><?= htmlentities($result['type']) ?></b></span>
    </div>
    <div class="row">
      <span class="label">Owner Email Address: </span>
      <span><b><?= htmlentities($result['owner_email']) ?></b></span>
    </div>
    <?php if($result['image'] != null) : ?>
    <div class="column">
      <img src="<?= $base_url . '/sites/default/files/' . $result['image'] ?>" class="img-responsive"/>
    </div>
    <?php endif; ?>
  </div>
</div>


</style>
