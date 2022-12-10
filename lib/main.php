<?php
function start_page()
{
    $menu = file_get_contents('layouts/menu.php');
    $navbar = file_get_contents('layouts/navbar.php');
    echo "
        <div class=\"layout-wrapper layout-content-navbar\">
            <div class=\"layout-container\">
            $menu

            <!-- Layout container -->
            <div class=\"layout-page\">
                <!-- Navbar -->
                $navbar
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class=\"content-wrapper\">
                    <div class=\"container-xxl flex-grow-1 container-p-y\">
    ";
}

function end_page()
{
    echo "
                    </div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class=\"layout-overlay layout-menu-toggle\"></div>
        </div>
    ";
}

function redirect($page) {
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("Location: http://$host$uri/$page");
}

function form_delete_start($formId, $action, $method) {
    echo '
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#'.$formId.'">
        <span class="tf-icons bx bx-trash"></span>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="'.$formId.'" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="'.$action.'" method="'.$method.'">';
}

function form_delete_end() {
    echo '
                <div class="modal-header">
                    <h5 class="modal-title">Hapus data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apa anda yakin ingin menghapus data?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tidak
                    </button>
                    <button type="submit" class="btn btn-primary">Ya</button>
                </div>
            </form>
        </div>
    </div>
    ';
}
?>