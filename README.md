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

Edit your theme/partials/checkout/form.php file as follows:

Replace:

```html
<div class="form-group">
    <label for="comment"><?= lang('igniter.cart::default.checkout.label_comment'); ?></label>
    <textarea
        name="comment"
        id="comment"
        rows="3"
        class="form-control"
    ><?= set_value('comment', $order->comment); ?></textarea>
</div>
```

with:

```html
<?php if (($tableData = Session::get('thoughtco.tables')) && ($tableData['location'] == $location->getId()) && $order->isCollectionType()){ ?>
<input type="hidden" name="comment" id="comment" value="Table <?= $tableData['table'] ?>" />
<?php } else { ?>
<div class="form-group">
    <label for="comment"><?= lang('igniter.cart::default.checkout.label_comment'); ?></label>
    <textarea
        name="comment"
        id="comment"
        rows="3"
        class="form-control"
    ><?= set_value('comment', $order->comment); ?></textarea>
</div>
<?php } ?>
```

This will hide the order comment field for any users that come through the table url and add the table information as a comment.

