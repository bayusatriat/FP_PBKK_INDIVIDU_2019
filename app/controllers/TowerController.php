<?php
use Phalcon\Http\Request;

// use form
use App\Forms\Tower\CreateTowerForm;
use Phalcon\Db\Column;

class TowerController extends ControllerBase
{
    public $createTowerForm;
    public $towerModel;
    
    public function initialize()
    {
        # Check User isLogin
        $this->authorized();
        $this->createTowerForm = new CreateTowerForm();
        $this->towerModel = new Towers();
    }

    /**
     * Create Tower
     */
    public function createAction()
    {
        /**
         * Changing dynamically the Document Title
         * ------------------------------------------
         * @setTitle()
         * @prependTitle()
         */
        $this->tag->setTitle('Phalcon :: Add Tower');
        // Login Form
        $this->view->form = new CreateTowerForm();
    }

    /**
     * Create Tower Action
     * @method: POST
     * @param: title
     * @param: description
     */
    public function createSubmitAction()
    {
        // check request
        if (!$this->request->isPost()) {
            return $this->response->redirect('user/login');
        }

        # https://docs.phalconphp.com/en/3.3/security#csrf

        // Validate CSRF token
        if (!$this->security->checkToken()) {
            $this->flashSession->error("Invalid Token");
            return $this->response->redirect('tower/create');
        }

        # Tower Form with Model
        $this->createTowerForm->bind($_POST, $this->towerModel);
        # Check Form Validation
        if (!$this->createTowerForm->isValid()) {
            foreach ($this->createTowerForm->getMessages() as $message) {
                $this->flashSession->error($message);
                $this->dispatcher->forward([
                    'controller' => $this->router->getControllerName(),
                    'action'     => 'create',
                ]);
                return;
            }
        }

        # Tower Set Save/Publish Value
        // if ($this->request->getPost('publish') != NULL) {
        //     // Tower Publish
        //     $this->towerModel->setIsPublic(1);

        // } else {
        //     // Tower Save Draft
        //     $this->towerModel->setIsPublic(0);
        // }

        // $this->towerModel->setUserId($this->session->get('AUTH_ID'));
        // $this->towerModel->setCreated(time());
        // $this->towerModel->setUpdated(time());

        # Doc :: https://docs.phalconphp.com/en/3.3/db-models#create-update-records
        if (!$this->towerModel->save()) {
            foreach ($this->towerModel->getMessages() as $m) {
                $this->flashSession->error($m);
                $this->dispatcher->forward([
                    'controller' => $this->router->getControllerName(),
                    'action'     => 'create',
                ]);
                return;
            }
        }

        $this->flashSession->success('Tower successfully saved.');
        return $this->response->redirect('tower/create');

        $this->view->disable();
    }

    /**
     * Manage Towers
     */
    public function manageAction()
    {
        $this->tag->setTitle('Phalcon :: Manage Towers');

        // Fetch All User Towers
        $towers = Towers::find([
            'bind'       => [
                1 => $this->session->get('AUTH_ID'),
            ],
            // 'columns' => 'id, title',
        ]);


        /**
         * Send Data in View Template
         * --------------------------------------------------------
         * $this->view->towersdata = "Auth ID";
         * $this->view->setVars(['towersdata' => "Auth ID"]);
         */
        $this->view->towersData = $towers;

        # View Page Disable
        // $this->view->disable();
    }

    /**
     * Edit Tower
     */
    public function editAction($towerId = null)
    {
        $url_id = urldecode(strtr($towerId,"'",'%'));
        $towerId = $this->crypt->decryptBase64($url_id);

        // Set Page Title
        $this->tag->setTitle('Phalcon :: Edit Tower');

        // Check tower id not empty
        if (!empty($towerId) AND $towerId != null)
        {
            // Check Post Request
            if($this->request->isPost())
            {
                # bind user type data
                $this->createTowerForm->bind($this->request->getPost(), $this->towerModel);
                $this->view->form = new CreateTowerForm($this->towerModel, [
                    "edit" => true
                ]);
                
            } else
            {
                // Fetch User Tower
                // $tower = Towers::findFirst([
                //     'conditions' => 'id = :1: AND user_id = :2:',
                //     'bind' => [
                //         '1' => $towerId,
                //         '2' => $this->session->get('AUTH_ID')
                //     ]
                // ]);

                $tower = Towers::find([
                    'bind'       => [
                        1 => $this->session->get('AUTH_ID'),
                    ]]);
                
                // if (!$tower) {
                //     $this->flashSession->error('Tower was not found');
                //     return $this->response->redirect('tower/create');
                // }

                // Send Tower Data in Tower Form
                $this->view->form = new CreateTowerForm($tower, [
                    "edit" => true
                ]);
            }
        } else {
            return $this->response->redirect('tower/manage');
        }
    }

    /**
     * Edit Tower Action Submit
     * @method: POST
     * @param: title
     * @param: description
     */
    public function editSubmitAction()
    {
        // check post request
        if (!$this->request->isPost()) {
            return $this->response->redirect('tower/manage');
        }

        // Validate CSRT Token
        if (!$this->security->checkToken()) {
            $this->flashSession->error("Invalid Token");
            return $this->response->redirect('tower/manage');
        }

        // get tower id
        $towerEID = $this->request->getPost("eid");

        /**
         * Decode Tower Eid
         */
        $towerID = $this->crypt->decryptBase64(urldecode(strtr($towerEID,"'",'%')));

        // Check Agin User Tower is Valid
        $tower = Towers::find([
            'conditions' => 'tower_id = :$towerID:',
            'bind'       => [
                1 => $towerID,
            ]]);

        if (!$tower) {
            $this->flashSession->error('Tower was not found');
            return $this->response->redirect('tower/create');
        }

        # Check Form Validation
        if (!$this->createTowerForm->isValid($this->request->getPost(), $tower)) {
            foreach ($this->createTowerForm->getMessages() as $message) {
                $this->flashSession->error($message);
                return $this->dispatcher->forward([
                    'controller' => $this->router->getControllerName(),
                    'action'     => 'edit',
                    'params' => [$towerID]
                ]);
            }
        }

        // Set Tower New Data

        # Tower Set Save/Publish Value
        // if ($this->request->getPost('publish') != NULL) {
        //     // Tower Publish
        //     $this->towerModel->setIsPublic(1);

        // } else {
        //     // Tower Save Draft
        //     $this->towerModel->setIsPublic(0);
        // }

        // tower id set
        // $this->towerModel->setTowerId($towerID);
        // $this->towerModel->setUserId($this->session->get('AUTH_ID'));
        // $this->towerModel->setCreated(time());
        // $this->towerModel->setUpdated(time());

        # Doc :: https://docs.phalconphp.com/en/3.3/db-models#create-update-records
        if ($this->towerModel->save($_POST) === false) {
            foreach ($this->towerModel->getMessages() as $m) {
                $this->flashSession->error($m);
            }

            return $this->dispatcher->forward([
                'controller' => $this->router->getControllerName(),
                'action'     => 'edit',
            ]);
        }

        // Clear Tower Form
        $this->createTowerForm->clear();

        $this->flashSession->success('Tower was updated successfully.');
        return $this->response->redirect('tower/manage');

        $this->view->disable();
    }

    /**
     * Delete Tower
     */
    public function deleteAction($towerEID)
    {
        /**
         * Decode Tower EID
         * ----------------------------------------------------
         * http://php.net/manual/en/function.urlencode.php
         */
        $towerID = $this->crypt->decryptBase64(urldecode(strtr($towerEID,"'",'%')));

        $id = (int) $towerID;
        if ($id > 0 AND !empty($id))
        {
            // Check Agin User Tower is Valid
            $tower = Towers::find([
                'bind'       => [
                    1 => $this->session->get('AUTH_ID'),
                ],
            ]);

            if (!$tower) {
                $this->flashSession->error('Tower was not found');
                return $this->response->redirect('tower/manage');
            }    

            if (!$tower->delete()) {
                foreach ($tower->getMessages() as $msg) {
                    $this->flashSession->error((string) $msg);
                }
                return $this->response->redirect("tower/manage");
            } else {
                $this->flashSession->success("Tower was deleted");
                return $this->response->redirect("tower/manage");
            }

        } else {
            $this->flashSession->error("Tower ID Invalid.");
            return $this->response->redirect("tower/manage");
        }

        # View Page Disable
        $this->view->disable();
    }
}