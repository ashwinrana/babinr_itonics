<?php

function babinr_itonics_products_create_form($form, &$form_state)
{
  $form = [
    'title' => [
      '#type' => 'textfield',
      '#title' => t('Product Title'),
      '#size' => 60,
      '#maxlength' => 191,
      '#required' => TRUE,
    ],
    'summary' => [
      '#type' => 'textarea',
      '#title' => 'Product Summary',
    ],
    'description' => [
      '#type' => 'text_format',
      '#title' => 'Product Description',
      '#format' => 'filtered_html',
    ],
    'category' => [
      '#type' => 'select',
      '#title' => t('Category'),
      '#multiple' => TRUE,
      '#required' => TRUE,
      '#options' => [
        'industry' => 'Industry',
        'functionality' => 'Functionality',
        'customer_needs' => 'Customer Needs',
        'customer_preferences' => 'Customer Preferences',
        'demographics' => 'Demographics'
      ]
    ],
    'type' => [
      '#type' => 'radios',
      '#title' => t('Type'),
      '#required' => TRUE,
      '#options' => [
        'consumer_products' => 'Consumer Products',
        'convenience_products' => 'Convenience Products',
        'shopping_products' => 'Shopping Products',
        'specialty_products' => 'Specialty Products'
      ]
    ],
    'owner_email' => [
      '#type' => 'textfield',
      '#title' => t('Owner Email'),
      '#required' => TRUE,
      '#element_validate' => [
        'babinr_itonics_create_from_email_validate'
      ]
    ],
    'expiry_date' => [
      '#type' => 'date_popup',
      '#title' => 'Expiry Date',
      '#datepicker' => 'datepicker',
      '#required' => TRUE,
    ],
    'submit' => [
      '#type' => 'submit',
      '#value' => t('Save')
    ],
    '#method' => 'post',
  ];

  return $form;
}

function babinr_itonics_create_from_email_validate($element, &$form_state, $form)
{
  $value = $element['#value'];
  if (!valid_email_address($value)) {
    form_error($element, t('Please input validate email address'));
  }
}

function babinr_itonics_products_create_form_submit($form, &$form_state)
{
  $data = $form_state['input'];
  db_insert(TABLE_NAME)
    ->fields([
      'title' => $data['title'],
      'summary' => $data['summary'],
      'description' => $data['description']['value'],
      'category' => implode(',', $data['category']),
      'type' => $data['type'],
      'owner_email' => $data['owner_email'],
      'expiry_date' => $data['expiry_date']['date']
    ])
    ->execute();

  drupal_set_message(t('Product Created Successfully'));
}
