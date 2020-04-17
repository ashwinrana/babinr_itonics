<?php
function babinr_itonics_products_edit_form($form, &$form_state, $product_id)
{
  $product = db_select(TABLE_NAME)->fields(TABLE_NAME)->condition('id', $product_id)->execute()->fetchAssoc('id');

  if (count($product) > 0) {
    $form = babinr_itonics_products_create_form($form, $form_state);
    $form['product_id'] = [
      '#type' => 'hidden',
      '#value' => $product['id']
    ];
    $form['title']['#value'] = $product['title'];
    $form['summary']['#value'] = $product['summary'];
    $form['description']['#value'] = $product['description'];
    $form['category']['#default_value'] = explode(',', $product['category']);
    $form['type']['#default_value'] = $product['type'];
    $form['owner_email']['#value'] = $product['owner_email'];
    $form['expiry_date']['#value'] = $product['expiry_date'];
    $form['submit']['#value'] = t('Update Product');

    return $form;
  }
}


function babinr_itonics_products_edit_form_email_validation($element, &$form_state, $form)
{
  $value = $element['#value'];
  if (!valid_email_address($value)) {
    form_error($element, t('Please input validate email address'));
  }
}

function babinr_itonics_products_edit_form_submit($form, &$form_state)
{
  $data = $form_state['input'];
  $product = db_select(TABLE_NAME)->fields(TABLE_NAME)->condition('id', $data['product_id'])->execute()->fetchAssoc('id');
  if(count($product) > 0) {
    db_update(TABLE_NAME)
      ->fields([
        'title' => $data['title'],
        'summary' => $data['summary'],
        'description' => $data['description']['value'],
        'category' => implode(',', $data['category']),
        'type' => $data['type'],
        'owner_email' => $data['owner_email'],
        'expiry_date' => $data['expiry_date']['date']
      ])
      ->condition('id', $data['product_id'])
      ->execute();
  }
  drupal_set_message(t('Product Update Successfully'));
}
