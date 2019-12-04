<?php
use Phalcon\Http\Request;

// use form
use App\Forms\Project\CreateProjectForm;
use Phalcon\Db\Column;

class ProjectController extends ControllerBase
{
    public $createProjectForm;
    public $projectModel;
    
    public function initialize()
    {
        # Check User isLogin
        $this->authorized();
        $this->createProjectForm = new CreateProjectForm();
        $this->projectModel = new Projects();
    }

    /**
     * Create Project
     */
    public function createAction()
    {
        /**
         * Changing dynamically the Document Title
         * ------------------------------------------
         * @setTitle()
         * @prependTitle()
         */
        $this->tag->setTitle('Phalcon :: Add Project');
        // Login Form
        $this->view->form = new CreateProjectForm();
    }

    /**
     * Create Project Action
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
            return $this->response->redirect('project/create');
        }

        # Project Form with Model
        $this->createProjectForm->bind($_POST, $this->projectModel);
        # Check Form Validation
        if (!$this->createProjectForm->isValid()) {
            foreach ($this->createProjectForm->getMessages() as $message) {
                $this->flashSession->error($message);
                $this->dispatcher->forward([
                    'controller' => $this->router->getControllerName(),
                    'action'     => 'create',
                ]);
                return;
            }
        }

        # Project Set Save/Publish Value
        // if ($this->request->getPost('publish') != NULL) {
        //     // Project Publish
        //     $this->projectModel->setIsPublic(1);

        // } else {
        //     // Project Save Draft
        //     $this->projectModel->setIsPublic(0);
        // }

        // $this->projectModel->setUserId($this->session->get('AUTH_ID'));
        // $this->projectModel->setCreated(time());
        // $this->projectModel->setUpdated(time());

        # Doc :: https://docs.phalconphp.com/en/3.3/db-models#create-update-records
        if (!$this->projectModel->save()) {
            foreach ($this->projectModel->getMessages() as $m) {
                $this->flashSession->error($m);
                $this->dispatcher->forward([
                    'controller' => $this->router->getControllerName(),
                    'action'     => 'create',
                ]);
                return;
            }
        }

        $this->flashSession->success('Project successfully saved.');
        return $this->response->redirect('project/create');

        $this->view->disable();
    }

    /**
     * Manage Projects
     */
    public function manageAction()
    {
        $this->tag->setTitle('Phalcon :: Manage Projects');

        // Fetch All User Projects
        $projects = Projects::find([
            'bind'       => [
                1 => $this->session->get('AUTH_ID'),
            ],
            // 'columns' => 'id, title',
        ]);


        /**
         * Send Data in View Template
         * --------------------------------------------------------
         * $this->view->projectsdata = "Auth ID";
         * $this->view->setVars(['projectsdata' => "Auth ID"]);
         */
        $this->view->projectsData = $projects;

        # View Page Disable
        // $this->view->disable();
    }

    /**
     * Edit Project
     */
    public function editAction($projectId = null)
    {
        $url_id = urldecode(strtr($projectId,"'",'%'));
        $projectId = $this->crypt->decryptBase64($url_id);

        // Set Page Title
        $this->tag->setTitle('Phalcon :: Edit Project');

        // Check project id not empty
        if (!empty($projectId) AND $projectId != null)
        {
            // Check Post Request
            if($this->request->isPost())
            {
                # bind user type data
                $this->createProjectForm->bind($this->request->getPost(), $this->projectModel);
                $this->view->form = new CreateProjectForm($this->projectModel, [
                    "edit" => true
                ]);
                
            } else
            {
                // Fetch User Project
                // $project = Projects::findFirst([
                //     'conditions' => 'id = :1: AND user_id = :2:',
                //     'bind' => [
                //         '1' => $projectId,
                //         '2' => $this->session->get('AUTH_ID')
                //     ]
                // ]);

                $project = Projects::find([
                    'bind'       => [
                        1 => $this->session->get('AUTH_ID'),
                    ]]);
                
                // if (!$project) {
                //     $this->flashSession->error('Project was not found');
                //     return $this->response->redirect('project/create');
                // }

                // Send Project Data in Project Form
                $this->view->form = new CreateProjectForm($project, [
                    "edit" => true
                ]);
            }
        } else {
            return $this->response->redirect('project/manage');
        }
    }

    /**
     * Edit Project Action Submit
     * @method: POST
     * @param: title
     * @param: description
     */
    public function editSubmitAction()
    {
        // check post request
        if (!$this->request->isPost()) {
            return $this->response->redirect('project/manage');
        }

        // Validate CSRT Token
        if (!$this->security->checkToken()) {
            $this->flashSession->error("Invalid Token");
            return $this->response->redirect('project/manage');
        }

        // get project id
        $projectEID = $this->request->getPost("eid");

        /**
         * Decode Project Eid
         */
        $projectID = $this->crypt->decryptBase64(urldecode(strtr($projectEID,"'",'%')));

        // Check Agin User Project is Valid
        $project = Projects::find([
            'conditions' => 'project_id = :$projectID:',
            'bind'       => [
                1 => $projectID,
            ]]);

        if (!$project) {
            $this->flashSession->error('Project was not found');
            return $this->response->redirect('project/create');
        }

        # Check Form Validation
        if (!$this->createProjectForm->isValid($this->request->getPost(), $project)) {
            foreach ($this->createProjectForm->getMessages() as $message) {
                $this->flashSession->error($message);
                return $this->dispatcher->forward([
                    'controller' => $this->router->getControllerName(),
                    'action'     => 'edit',
                    'params' => [$projectID]
                ]);
            }
        }

        // Set Project New Data

        # Project Set Save/Publish Value
        // if ($this->request->getPost('publish') != NULL) {
        //     // Project Publish
        //     $this->projectModel->setIsPublic(1);

        // } else {
        //     // Project Save Draft
        //     $this->projectModel->setIsPublic(0);
        // }

        // project id set
        // $this->projectModel->setProjectId($projectID);
        // $this->projectModel->setUserId($this->session->get('AUTH_ID'));
        // $this->projectModel->setCreated(time());
        // $this->projectModel->setUpdated(time());

        # Doc :: https://docs.phalconphp.com/en/3.3/db-models#create-update-records
        if ($this->projectModel->save($_POST) === false) {
            foreach ($this->projectModel->getMessages() as $m) {
                $this->flashSession->error($m);
            }

            return $this->dispatcher->forward([
                'controller' => $this->router->getControllerName(),
                'action'     => 'edit',
            ]);
        }

        // Clear Project Form
        $this->createProjectForm->clear();

        $this->flashSession->success('Project was updated successfully.');
        return $this->response->redirect('project/manage');

        $this->view->disable();
    }

    /**
     * Delete Project
     */
    public function deleteAction($projectEID)
    {
        /**
         * Decode Project EID
         * ----------------------------------------------------
         * http://php.net/manual/en/function.urlencode.php
         */
        $projectID = $this->crypt->decryptBase64(urldecode(strtr($projectEID,"'",'%')));

        $id = (int) $projectID;
        if ($id > 0 AND !empty($id))
        {
            // Check Agin User Project is Valid
            $project = Projects::find([
                'bind'       => [
                    1 => $this->session->get('AUTH_ID'),
                ],
            ]);

            if (!$project) {
                $this->flashSession->error('Project was not found');
                return $this->response->redirect('project/manage');
            }    

            if (!$project->delete()) {
                foreach ($project->getMessages() as $msg) {
                    $this->flashSession->error((string) $msg);
                }
                return $this->response->redirect("project/manage");
            } else {
                $this->flashSession->success("Project was deleted");
                return $this->response->redirect("project/manage");
            }

        } else {
            $this->flashSession->error("Project ID Invalid.");
            return $this->response->redirect("project/manage");
        }

        # View Page Disable
        $this->view->disable();
    }
}