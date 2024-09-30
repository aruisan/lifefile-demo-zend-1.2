<?php

use application\models\Album;

class IndexController extends Zend_Controller_Action {
    protected $albumModel;

  
    public function init() {
        // Cargar el modelo
        $this->albumModel = new Album();
    }
    // Acción para mostrar todos los álbumes
    public function indexAction() {
        $this->view->albums = $this->albumModel->fetchAll();
    }

    // Acción para agregar un nuevo álbum
    public function addAction() {
        if ($this->_request->isPost()) {
            $data = array(
                'artist' => $this->_request->getPost('artist'),
                'title' => $this->_request->getPost('title'),
            );
            $this->albumModel->insert($data);
            $this->_redirect('/index');
        }
    }

    // Acción para editar un álbum existente
    public function editAction() {
        $id = $this->_getParam('id');
        $album = $this->albumModel->fetchRow('id = ' . (int)$id);

        if ($this->_request->isPost()) {
            $data = array(
                'artist' => $this->_request->getPost('artist'),
                'title' => $this->_request->getPost('title'),
            );
            $this->albumModel->update($data, 'id = ' . (int)$id);
            $this->_redirect('/index');
        }

        $this->view->album = $album;
    }

    // Acción para eliminar un álbum
    public function deleteAction() {
        $id = $this->_getParam('id');
        if ($this->_request->isPost()) {
            $this->albumModel->delete('id = ' . (int)$id);
            $this->_redirect('/index');
        } else {
            $this->view->album = $this->albumModel->fetchRow('id = ' . (int)$id);
        }
    }
}
