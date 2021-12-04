<?php
session_start();

if(isset($_SESSION["user"])) {
    $conn = include './db_conn.php';
    $user = $_SESSION["user"];
    if($conn) {
        $sql = "SELECT * FROM users WHERE uname='$user' LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()) {
                $sql = "SELECT * FROM addresses WHERE id_user='".$row['id']."' LIMIT 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    if($row2 = $result->fetch_assoc()) {
                        echo '
                        <form name="updateForm" action="src/php/update_account.php" method="post">
                            <div class="left-panel flex-panel">
                                <div class="box-container">
                                    <div class="margin-container">
                                        <div class="margin-title">L’impressionnisme</div>
                                    </div>
                                    <div class="margin-content">
                                        <div class="data-container">
                                            <div class="link-container">
                                                <div class="history">Historial</div>
                                            </div>
                                            <div class="input-container">
                                                <div class="label">Usuario: '.$row["uname"].'</div>
                                            </div>
                                            <div class="input-container">
                                                <div class="label">Nombre(s)</div>
                                                <input type="text" name="name" value="'.$row["name"].'" required>
                                            </div>
                                            <div class="input-container">
                                                <div class="label">Apellidos</div>
                                                <input type="text" name="lname" value="'.$row["lname"].'" required>
                                            </div>
                                            <div class="input-container">
                                                <div class="label">Correo</div>
                                                <input type="email" name="email" onfocusout="registerEmail()" value="'.$row["email"].'" required>
                                            </div>
                                            <div class="input-container">
                                                <div class="label">Contraseña</div>
                                                <input type="password" name="pswd" onfocusout="checkPswd()">
                                            </div>
                                            <div class="input-container">
                                                <div class="label">Repite contraseña</div>
                                                <input type="password" name="rpswd" onfocusout="checkPswd()">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="right-panel flex-panel">
                                <div class="box-container">
                                    <div class="margin-content">
                                        <div class="data-container">
                                            <div class="input-container">
                                                <div class="label">Estado</div>
                                                <input type="text" name="state" value="'.$row2["state"].'" required>
                                            </div>
                                            <div class="input-container">
                                                <div class="label">Ciudad</div>
                                                <input type="text" name="town" value="'.$row2["town"].'" required>
                                            </div>
                                            <div class="input-container">
                                                <div class="label">Colonia</div>
                                                <input type="text" name="colony" value="'.$row2["colony"].'" required>
                                            </div>
                                            <div class="input-container">
                                                <div class="label">Dirección</div>
                                                <input type="text" name="address" value="'.$row2["address"].'" required>
                                            </div>
                                            <div class="input-container">
                                                <div class="label">Código postal</div>
                                                <input type="text" name="zip" minlength="5" maxlength="5" value="'.$row2["zip_code"].'" required>
                                            </div>
                                            <div class="link-container">
                                                <input type="submit" value="Actualizar información" class="button">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="margin-container">
                                        <div class="margin-title-rev">L’impressionnisme</div>
                                    </div>
                                </div>
                                <div class="history-container">
                                    <div class="history-element">
                                    </div>
                                </div>
                            </div>      
                        </form>
                        <img class="close-data close-ico" src="./static/ico/cross.svg" alt="close icon">
                        ';
                    }
                }
            }
        }
        else echo FALSE;

        $conn->close();
    }
}
else echo FALSE;
?>