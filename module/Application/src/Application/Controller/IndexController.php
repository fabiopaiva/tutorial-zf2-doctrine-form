<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Form\Cliente as ClienteForm;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $clientes = $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager')
            ->getRepository('Application\Entity\Cliente')
            ->findAll();
        return array(
            'clientes' => $clientes
        );
    }

    public function adicionarAction()
    {
        $form = new ClienteForm('cliente', array(
            'om' => $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
        ));
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()
                ->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getServiceLocator()
                    ->get('Doctrine\ORM\EntityManager')
                    ->persist($data);
                $this->getServiceLocator()
                    ->get('Doctrine\ORM\EntityManager')
                    ->flush();
                $this->redirect()->toRoute('tutorial');
            }
        }
        $form->prepare();
        return array(
            'form' => $form
        );
    }

    public function editarAction()
    {
        $form = new ClienteForm('cliente', array(
            'om' => $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
        ));
        $id = $this->params()->fromRoute('id');
        $cliente = $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager')
            ->getRepository('Application\Entity\Cliente')
            ->findOneById($id);
        $form->bind($cliente);
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()
                ->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getServiceLocator()
                    ->get('Doctrine\ORM\EntityManager')
                    ->persist($data);
                $this->getServiceLocator()
                    ->get('Doctrine\ORM\EntityManager')
                    ->flush();
                $this->redirect()->toRoute('tutorial');
            }
        }
        $form->prepare();
        return array(
            'form' => $form
        );
    }

    public function removerAction()
    {
        $id = $this->params()->fromRoute('id');
        $cliente = $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager')
            ->getRepository('Application\Entity\Cliente')
            ->findOneById($id);
        $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager')
            ->remove($cliente);
        $this->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager')
            ->flush();
        $this->redirect()->toRoute('tutorial');
    }
}
