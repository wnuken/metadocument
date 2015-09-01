<table class="table table-bordered table-striped js-options-table">
    <tr>
        <th>#</th>
        <th>Título</th>
        <th>Descarga</th>
        <th class="hidden-xs">Vista Previa</th>
        <th class="hidden-xs">Fecha de emision</th>
        <th class="hidden-xs">Fecha de Actualización</th>
    </tr>
    <?php foreach($filesList as $key => $file): ?>
    <tr>
        <th scope="row"><?php print ($key + 1); ?></th>
        <td class="hidden-xs">
            <a href="<?php print $file->alternateLink; ?>" target="_blank">
                <h4>
                    <img src="<?php print $file->iconLink; ?>" alt="<?php print $file->mimeType; ?>" title="<?php print $file->mimeType; ?>">
                    <?php print $file->getTitle(); ?>
                </h4>
            </a>
        </td>
        <td>

            <?php 
            if(isset($file->exportLinks)){
                foreach($file->exportLinks as $keyb => $exportlink){ 
                    $iconName = $General->setNameIcon($keyb);

                    print "<div class='col-sm-12 col-md-4 col-lg-4'><a href='" . $exportlink . $linkToken . "'><img width='32' src='./img/icon/" . $iconName . "'></a> </div>";

                } 
            }else if(isset($file->downloadUrl)){
                $iconName = $General->setNameIcon($file->mimeType);

                print "<div class='col-sm-12 col-md-4 col-lg-4'><a href='" . $file->downloadUrl . $linkToken . "'><img width='32' src='./img/icon/" . $iconName . "'></a> </div>";

            }
            ?>

        </td>
        <td>
            <?php if(isset($_SESSION['access_token'])){ 
                print '<img width="128" src="'. $file->thumbnailLink .'" alt="' . $file->mimeType . '">';
            }elseif (isset($_SESSION['service_token']) && $file->mimeType == 'application/vnd.google-apps.document') {
                print '<img width="128" src="'. $file->thumbnailLink . $linkToken . '" alt="' . $file->mimeType . '">';
            }elseif (isset($_SESSION['service_token'])) { 
                print '<img width="128" src="'. $file->thumbnailLink  . '" alt="' . $file->mimeType . '">';
            } ?>
        </td>



        <td class="hidden-xs"><?php print date('Y-m-d h:i:s a',strtotime($file->createdDate)); ?></td>

        <td class="hidden-xs"><?php print date('Y-m-d h:i:s a',strtotime($file->modifiedDate)); ?></td>

    </tr>
    <?php 
    endforeach; 

    ?>
</table>