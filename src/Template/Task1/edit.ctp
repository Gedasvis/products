<?php 

echo $this->Form->create($product, ['enctype' => 'multipart/form-data']);
echo $this->Form->control('name', ['label' => 'Name']);
echo $this->Form->control('price', ['label' => 'Price']);
echo $this->Form->control('description', ['label' => 'Description']);
echo $this->Html->image('uploads/' . $photo);
echo $this->Form->control('image', ['type' => 'file', 'label' => 'Photo']);
echo $this->Form->control('rating', ['label' => 'Please rate this product', 'type' => 'select', 
                          'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], 'value' => 5]);
echo $this->Form->button('Update');
echo $this->Form->end();

?>