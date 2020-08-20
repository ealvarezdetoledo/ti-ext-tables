## Add table selection

Enables service to tables by adding a table endpoint and adding the value to the order comment.

### Table url
Once installed a new location url is available in the format "$location/table/$id", e.g. /default/table/22. You should direct customers to this through the use of a QR code or visible URL on the table.

This information will be stored the session under the key "thoughtco.tables", which you can access within your templates as follows:

```php
$tableData = Session::get('thoughtco.tables');
// ['location' => xxx, 'id' => xxx]
```

### Amend templates
The simplest way to pass the table number to the backend is through the order comment.

Edit your theme/partials/checkout/form.php file to include the table number, for example:

```html
<?php if (($tableData = Session::get('thoughtco.tables')) && ($tableData['location'] == $location->getId()) && $order->isCollectionType()){ ?>
<input type="hidden" name="table_number" value="<?= $tableData['table'] ?>" />
<?php } ?>
```

This will populate the table_number field on a order, when it is present.

