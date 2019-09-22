<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\View\Exception\MissingTemplateException;

use Cake\Utility\Xml;
use Cake\Utility\Hash;

class Task1Controller extends AppController
{

    public function index()
    {
        $p = TableRegistry::getTableLocator()->get('products');
        $a = $p->find('all', ['contain' => 'ProductRatings'])->toArray();

        $this->set('a', $a);

        $ratings = [];
        
        foreach($a as $product)
        {
            $sum = 0;
            $count = 0;
            $avg = 0;
        
            foreach($product['product_ratings'] as $r)
            {
                $sum += $r['score'];
                $count++;
            }
            
            if($count > 0)
            {
                $avg = $sum / $count;
            }
            
            if($avg == 0)
            {
                $ratings[$product['id']] = 'Not rated yet.';
            }
            else
            {
                $ratings[$product['id']] = number_format((float)$avg, 2, '.', '');
            }
        }

        $this->set('ratings', $ratings);
    }

    public function add()
    {
        $products = TableRegistry::getTableLocator()->get('products');
        $product = $products->newEntity();
        $this->set('product', $product);

        if($this->request->is('post'))
        {
            $product = $products->newEntity($this->request->getData());

            if(!empty($this->request->data['image']['name']))
            {
                    $file = $this->request->data['image'];

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'png');

                    if(in_array($ext, $arr_ext))
                    {
                        $str = $file['name'];
                        $encodedStr = sha1($str);
                        while(file_exists(WWW_ROOT . 'img/uploads/' . $encodedStr))
                        {
                            $str = rand();
                            $encodedStr = sha1($str);
                        }

                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/uploads/' . $encodedStr . '.' . $ext);
                        $product['photo'] = $encodedStr;

                    }
            }

            if($products->save($product))
            {
                $this->Flash->success(__('The product has been added.'));
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error(__('The product could not be added. Please, try again.'));
            }
        }
    }

    public function edit()
    {
        $products = TableRegistry::getTableLocator()->get('products');
        $id = $this->request->getQuery('id');

        $product = $products->get($id);
        $this->set('product', $product);
        $this->set('photo', $product->photo);

        $ratings = TableRegistry::getTableLocator()->get('ProductRatings');
        $rating = $ratings->newEntity();
        
        if($this->request->is(['post', 'put']))
        {
            if(!empty($this->request->data['image']['name']))
            {
                    $file = $this->request->data['image'];

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                    $arr_ext = array('jpg', 'jpeg', 'png');

                    if(in_array($ext, $arr_ext))
                    {
                        $str = $file['name'];
                        $encodedStr = sha1($str);
                        while(file_exists(WWW_ROOT . 'img/uploads/' . $encodedStr))
                        {
                            $str = rand();
                            $encodedStr = sha1($str);
                        }

                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/uploads/' . $encodedStr . '.' . $ext);
                        $product['photo'] = $encodedStr;

                    }
            } 

            $products->patchEntity($product, $this->request->getData());
            $rating['score'] = $this->request->data['rating'];
            $rating['product_id'] = $product->id;
            
            if($products->save($product))
            {
                $ratings->save($rating);
                $this->Flash->success(__('The product has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error(__('The product could not be updated. Please, try again.'));
            }
        }
    }

    public function delete()
    {
        $products = TableRegistry::getTableLocator()->get('products');
        $id = $this->request->getQuery('id');
        $product = $products->get($id);

        if($products->delete($product))
        {
            $this->Flash->success(__('The product has been deleted.'));
            return $this->redirect(['action' => 'index']);
        }
        else
        {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }
    }

    public function exporttocsv()
    {
        $p = TableRegistry::getTableLocator()->get('products');
        $data = $p->find('all')->toArray();

        $this->response->download("products.csv");

        $this->set(compact('data'));

        $this->layout = 'ajax';
    }

    public function exporttoxml()
    {
        $p = TableRegistry::getTableLocator()->get('products');
        $data = $p->find('all')->toArray();

        $newArray = ['Products' => []];
        $count = 0;

        foreach($data as $product)
        {
            $newArray = Hash::insert($newArray, 'Products.Product' . $count, $product->toArray());
            $count++;
        }

        $xmlObject = Xml::build($newArray);

        $this->response->download("products.xml");

        $this->set(compact('xmlObject'));

        $this->layout = 'ajax';
    }
}


