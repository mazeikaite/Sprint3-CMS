<?php

namespace Models;

include_once "bootstrap.php";

// Helper functions
function redirect_to_root()
{
    header("Location: " . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
}

// Add new project
if (isset($_GET['nameProj'])) {
    $project = new Project();
    $project->setProjectName($_GET['nameProj']);
    $entityManager->persist($project);
    $entityManager->flush();
    redirect_to_root();
}

// Delete project
if (isset($_GET['deleteProj'])) {
    $project = $entityManager->find('Models\Project', $_GET['deleteProj']);
    $entityManager->remove($project);
    $entityManager->flush();
    redirect_to_root();
}

// Update
if (isset($_POST['update_name'])) {
    $project = $entityManager->find('Models\Project', $_POST['update_id']);
    $project->setProjectName($_POST['update_name']);
    $entityManager->flush();
    redirect_to_root();
}


// Print all projects
$projects = $entityManager->getRepository('Models\Project')->findAll();
print("<table>");
?>

<thead>
    <tr>
        <th>ID</th>
        <th>Project Name</th>
        <!-- <th>Employees on Project</th> -->
        <th colspan="2">Actions</th>
    </tr>
</thead>
<tbody>

    <?php

    foreach ($projects as $p)
        print("<tr>"
            . "<td>" . $p->getProjectId()  . "</td>"
            . "<td>" . $p->getProjectName() . "</td>"
            . "<td><a href=\"?deleteProj={$p->getProjectId()}\">DELETE</a></td>"
            . "<td><a href=\"?updatableProj={$p->getProjectId()}\">UPDATE</a></td>"
            . "</tr>");
    print("</tbody></table>");


    if (isset($_GET['updatableProj'])) {
        $project = $entityManager->find('Models\Project', $_GET['updatableProj']);
        print("
        <form action=\"\" method=\"POST\">
            <input type=\"hidden\" name=\"update_id\" value=\"{$project->getProjectId()}\">
            <label for=\"name\">Update Project name </label><br>
            <input type=\"text\" name=\"update_name\" value=\"{$project->getProjectName()}\"><br>
            <input type=\"submit\" value=\"Submit\">
        </form>
    ");
    }



    ?>
    <!-- Add new project form -->
    <form action="" method="GET">
        <label for="nameProj">Add new project: </label><br>
        <input type="text" name="nameProj" value=""><br>
        <input type="submit" value="Submit">
    </form>