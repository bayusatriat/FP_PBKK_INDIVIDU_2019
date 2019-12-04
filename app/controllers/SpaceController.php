<?php
use Phalcon\Http\Request;

// use form
use App\Forms\Space\CreateSpaceForm;
use Phalcon\Db\Column;

class SpaceController extends ControllerBase
{
    public $createSpaceForm;
    public $spaceModel;
    
    public function initialize()
    {
        # Check User isLogin
        $this->authorized();
        $this->createSpaceForm = new CreateSpaceForm();
        $this->spaceModel = new Spaces();
    }

    /**
     * Create Space
     */
    public function createAction()
    {
        /**
         * Changing dynamically the Document Title
         * ------------------------------------------
         * @setTitle()
         * @prependTitle()
         */
        $this->tag->setTitle('Phalcon :: Add Space');
        // Login Form
        $this->view->form = new CreateSpaceForm();
    }

    /**
     * Create Space Action
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
            return $this->response->redirect('space/create');
        }

        # Space Form with Model
        $this->createSpaceForm->bind($_POST, $this->spaceModel);
        # Check Form Validation
        if (!$this->createSpaceForm->isValid()) {
            foreach ($this->createSpaceForm->getMessages() as $message) {
                $this->flashSession->error($message);
                $this->dispatcher->forward([
                    'controller' => $this->router->getControllerName(),
                    'action'     => 'create',
                ]);
                return;
            }
        }

        # Space Set Save/Publish Value
        // if ($this->request->getPost('publish') != NULL) {
        //     // Space Publish
        //     $this->spaceModel->setIsPublic(1);

        // } else {
        //     // Space Save Draft
        //     $this->spaceModel->setIsPublic(0);
        // }

        // $this->spaceModel->setUserId($this->session->get('AUTH_ID'));
        // $this->spaceModel->setCreated(time());
        // $this->spaceModel->setUpdated(time());

        # Doc :: https://docs.phalconphp.com/en/3.3/db-models#create-update-records
        if (!$this->spaceModel->save()) {
            foreach ($this->spaceModel->getMessages() as $m) {
                $this->flashSession->error($m);
                $this->dispatcher->forward([
                    'controller' => $this->router->getControllerName(),
                    'action'     => 'create',
                ]);
                return;
            }
        }

        $this->flashSession->success('Space successfully saved.');
        return $this->response->redirect('space/create');

        $this->view->disable();
    }

    /**
     * Manage Spaces
     */
    public function manageAction()
    {
        $this->tag->setTitle('Phalcon :: Manage Spaces');

        // Fetch All User Spaces
        $spaces = Spaces::find([
            'bind'       => [
                1 => $this->session->get('AUTH_ID'),
            ],
            // 'columns' => 'id, title',
        ]);


        /**
         * Send Data in View Template
         * --------------------------------------------------------
         * $this->view->spacesdata = "Auth ID";
         * $this->view->setVars(['spacesdata' => "Auth ID"]);
         */
        $this->view->spacesData = $spaces;

        # View Page Disable
        // $this->view->disable();
    }

    /**
     * Edit Space
     */
    public function editAction($spaceId = null)
    {
        $url_id = urldecode(strtr($spaceId,"'",'%'));
        $spaceId = $this->crypt->decryptBase64($url_id);

        // Set Page Title
        $this->tag->setTitle('Phalcon :: Edit Space');

        // Check space id not empty
        if (!empty($spaceId) AND $spaceId != null)
        {
            // Check Post Request
            if($this->request->isPost())
            {
                # bind user type data
                $this->createSpaceForm->bind($this->request->getPost(), $this->spaceModel);
                $this->view->form = new CreateSpaceForm($this->spaceModel, [
                    "edit" => true
                ]);
                
            } else
            {
                // Fetch User Space
                // $space = Spaces::findFirst([
                //     'conditions' => 'id = :1: AND user_id = :2:',
                //     'bind' => [
                //         '1' => $spaceId,
                //         '2' => $this->session->get('AUTH_ID')
                //     ]
                // ]);

                $space = Spaces::find([
                    'bind'       => [
                        1 => $this->session->get('AUTH_ID'),
                    ]]);
                
                // if (!$space) {
                //     $this->flashSession->error('Space was not found');
                //     return $this->response->redirect('space/create');
                // }

                // Send Space Data in Space Form
                $this->view->form = new CreateSpaceForm($space, [
                    "edit" => true
                ]);
            }
        } else {
            return $this->response->redirect('space/manage');
        }
    }

    /**
     * Edit Space Action Submit
     * @method: POST
     * @param: title
     * @param: description
     */
    public function editSubmitAction()
    {
        // check post request
        if (!$this->request->isPost()) {
            return $this->response->redirect('space/manage');
        }

        // Validate CSRT Token
        if (!$this->security->checkToken()) {
            $this->flashSession->error("Invalid Token");
            return $this->response->redirect('space/manage');
        }

        // get space id
        $spaceEID = $this->request->getPost("eid");

        /**
         * Decode Space Eid
         */
        $spaceID = $this->crypt->decryptBase64(urldecode(strtr($spaceEID,"'",'%')));

        // Check Agin User Space is Valid
        $space = Spaces::find([
            'conditions' => 'space_id = :$spaceID:',
            'bind'       => [
                1 => $spaceID,
            ]]);

        if (!$space) {
            $this->flashSession->error('Space was not found');
            return $this->response->redirect('space/create');
        }

        # Check Form Validation
        if (!$this->createSpaceForm->isValid($this->request->getPost(), $space)) {
            foreach ($this->createSpaceForm->getMessages() as $message) {
                $this->flashSession->error($message);
                return $this->dispatcher->forward([
                    'controller' => $this->router->getControllerName(),
                    'action'     => 'edit',
                    'params' => [$spaceID]
                ]);
            }
        }

        // Set Space New Data

        # Space Set Save/Publish Value
        // if ($this->request->getPost('publish') != NULL) {
        //     // Space Publish
        //     $this->spaceModel->setIsPublic(1);

        // } else {
        //     // Space Save Draft
        //     $this->spaceModel->setIsPublic(0);
        // }

        // space id set
        // $this->spaceModel->setSpaceId($spaceID);
        // $this->spaceModel->setUserId($this->session->get('AUTH_ID'));
        // $this->spaceModel->setCreated(time());
        // $this->spaceModel->setUpdated(time());

        # Doc :: https://docs.phalconphp.com/en/3.3/db-models#create-update-records
        if ($this->spaceModel->save($_POST) === false) {
            foreach ($this->spaceModel->getMessages() as $m) {
                $this->flashSession->error($m);
            }

            return $this->dispatcher->forward([
                'controller' => $this->router->getControllerName(),
                'action'     => 'edit',
            ]);
        }

        // Clear Space Form
        $this->createSpaceForm->clear();

        $this->flashSession->success('Space was updated successfully.');
        return $this->response->redirect('space/manage');

        $this->view->disable();
    }

    /**
     * Delete Space
     */
    public function deleteAction($spaceEID)
    {
        /**
         * Decode Space EID
         * ----------------------------------------------------
         * http://php.net/manual/en/function.urlencode.php
         */
        $spaceID = $this->crypt->decryptBase64(urldecode(strtr($spaceEID,"'",'%')));

        $id = (int) $spaceID;
        if ($id > 0 AND !empty($id))
        {
            // Check Agin User Space is Valid
            $space = Spaces::find([
                'bind'       => [
                    1 => $this->session->get('AUTH_ID'),
                ],
            ]);

            if (!$space) {
                $this->flashSession->error('Space was not found');
                return $this->response->redirect('space/manage');
            }    

            if (!$space->delete()) {
                foreach ($space->getMessages() as $msg) {
                    $this->flashSession->error((string) $msg);
                }
                return $this->response->redirect("space/manage");
            } else {
                $this->flashSession->success("Space was deleted");
                return $this->response->redirect("space/manage");
            }

        } else {
            $this->flashSession->error("Space ID Invalid.");
            return $this->response->redirect("space/manage");
        }

        # View Page Disable
        $this->view->disable();
    }
}