<?php 

echo $this->Form->create($product, ['enctype' => 'multipart/form-data']); 
echo $this->Form->control('name', ['label' => 'Name']);
echo $this->Form->control('price', ['label' => 'Price']);
echo $this->Form->control('description', ['label' => 'Description']);
echo $this->Form->control('image', ['type' => 'file', 'label' => 'Photo']);
echo $this->Form->button('Add');
echo $this->Form->end();

?>