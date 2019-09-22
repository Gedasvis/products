<h2>Task 1</h2>
<h3>Intro</h3>
<p>
    Connect to database. Run miggrations and seeds.
</p>
<p>
    Create a web app with:
    <ul>
        <li>Product list (CRUD)</li>
        <li>Option to upload photo to selected product</li>
        <li>Option to Rate product from 1 to 5. Show average score.</li>
        <li>Export all products as csv or xml</li>
    </ul>
</p>

<h3>Implementation</h3>

<?= $this->Html->link('Add a new product', ['controller' => 'Task1', 'action' => 'add']) ?><br>
<?= $this->Html->link('Export products data to CSV', 
                     ['controller' => 'Task1', 'action' => 'exporttocsv']) ?><br>
<?= $this->Html->link('Export products data to XML', 
                     ['controller' => 'Task1', 'action' => 'exporttoxml']) ?>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Photo</th>
    <th>Actions</th>
  </tr>
  <?php foreach ($a as $item): ?>
  <tr>
    <td><?= $item->id ?></td>
    <td><?= $item->name ?></td>
    <td><?= $item->description ?></td>
    <td><?= $item->price ?> $</td>
    <td>
    <?php if($item->photo == '') 
    { 
        echo 'There is no photo yet.'; 
    }
    else
    {
        echo $this->Html->image('uploads/' . $item->photo);
    }?>
    </td>
    <td><?= $this->Html->link('Edit', ['controller' => 'Task1', 'action' => 'edit', 'id' => $item->id]);?><br>
        <?= $this->Html->link('Delete', ['controller' => 'Task1', 'action' => 'delete', 'id' => $item->id]);?><br>
        <?= 'Rating: ' . $ratings[$item->id]?></td>
  </tr>
  <?php endforeach; ?>
</table>
