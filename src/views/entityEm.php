<?php

namespace Models;

include_once "bootstrap.php";

// Helper functions
function redirect_to_root()
{
    header("Location: " . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
}

// Add new employee and SELECT PROJECT
if (isset($_GET['name'])) {
    $employee = new Employee();
    $employee->setName($_GET['name']);

    $project = $entityManager->find('Models\Project', $_GET['project_id']);

    $employee->setProject($project);
    $project->addEmployee($employee);

    $entityManager->persist($employee);
    $entityManager->persist($project);

    $entityManager->flush();
    redirect_to_root();
}

// Delete 

if (isset($_GET['delete'])) {
    $employee = $entityManager->find('Models\Employee', $_GET['delete']);
    $entityManager->remove($employee);
    $entityManager->flush();
    redirect_to_root();
}


// Update
if (isset($_POST['update_name'])) {
    $employee = $entityManager->find('Models\Employee', $_POST['update_id']);
    $employee->setName($_POST['update_name']);
    $entityManager->flush();
    redirect_to_root();
}



// Print table
$employees = $entityManager->getRepository('Models\Employee')->findAll();
print("<table>");
?>

<thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Project</th>
        <th colspan="2">Actions</th>
    </tr>
</thead>
<tbody>
    <tr>

        <?php

        foreach ($employees as $p)
            print("<tr>"
                . "<td>" . $p->getId()  . "</td>"
                . "<td>" . $p->getName() . "</td>"
                . "<td>" . $p->getProject() . "</td>"
                . "<td><a href=\"?delete={$p->getId()}\">DELETE</a></td>"
                . "<td><a href=\"?updatable={$p->getId()}\">UPDATE</a></td>"
                . "</tr>");
        print("</table>");


        if (isset($_GET['updatable'])) {
            $employee = $entityManager->find('Models\Employee', $_GET['updatable']);
            print("
        <form action=\"\" method=\"POST\">
            <input type=\"hidden\" name=\"update_id\" value=\"{$employee->getId()}\">
            <label for=\"name\">Update Employee name: </label><br>
            <input type=\"text\" name=\"update_name\" value=\"{$employee->getName()}\"><br>
            <input type=\"submit\" value=\"Submit\">
        </form>
    ");
        }
        ?>
        <!-- Add new employee -->
        <form action="" method="GET">
            <h4>Add new Employee </h4>
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" Required>
            </div>
            <div>
                <label for="project_id">Choose</label>
                <select id="project_id" name="project_id">
                    <option selected="selected" disabled="disabled">Select a Project</option>
                    <?php
                    // Print projects in select options
                    $projects = $entityManager->getRepository('Models\Project')->findAll();
                    foreach ($projects as $p) {
                        print('<option value="' . $p->getProjectId() . '">' . $p->getProjectName() . '</option>');
                    }
                    ?>
                </select>
            </div>

            <input type="submit" value="Submit">
        </form>