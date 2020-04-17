<?php

global $base_url;
?>

<div class="table table-responsive">
  <div class="product_header">
    <a href="<?= $base_url . '/product/create' ?>">
      <button class="button"> Add Product</button>
    </a>
  </div>
  <table>
    <thead>
    <?php foreach ($headers as $header) : ?>
      <th><?= $header ?></th>
    <?php endforeach; ?>
    <?php foreach ($rows as $row) : ?>
      <tr>
        <?php foreach ($row as $value) : ?>
          <td><?= $value; ?></td>
        <?php endforeach; ?>
      </tr>
    <?php endforeach; ?>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
