<?php defined('ALTUMCODE') || die() ?>


<div class="row mt-5">
    <div class="col-12 col-lg mb-3 mb-lg-0">
        <h2 class="h3 m-0">Ayarlar</h2>
    </div>

    <div class="col-12 col-lg-auto d-flex" >
        <div>
                            <a href="<?= url('support-create/' . $data->campaign->campaign_id) ?>" class="btn btn-primary"><svg class="svg-inline--fa fa-plus fa-w-14 fa-fw fa-sm" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg><!-- <i class="fa fa-fw fa-sm fa-plus"></i> Font Awesome fontawesome.com --> Destek Talebi Oluştur</a>
                    </div>

       
    </div>
</div>






 <?php if(count($data->support)): ?>
    


    <div class="table-responsive table-custom-container mt-3">
        <table class="table table-custom">
            <thead>
            <tr>
                <th>Talep Adı</th>
                <th class="d-none d-md-table-cell">Talep Kategorisi</th>
                <th>Durumu</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

                            
                <tr>
                    <td class="text-nowrap">
                        <div class="d-flex flex-column">
                            <a href="https://app.eticaret.pro/support/87">Sepette Ödeme Hatası</a>

                            <div class="text-muted">
                                17.03.2023                 </div>
                        </div>
                    </td>
                    <td class="text-nowrap d-none d-md-table-cell">
                        <div class="text-muted d-flex flex-column">

                            <span> <i class="fa fa-fw fa-info-circle fa-sm mr-1"></i> Web Sitesi Yazılım Desteği    </small>
                        </div>
                    </td>
                    <td class="text-nowrap d-none d-md-table-cell">
                        <span>Yanıt bekleniyor</span>
                    </td>
                    
                    <td>
                        <div class="d-flex justify-content-end">
                            <div class="dropdown">
                                <button type="button" class="btn btn-link text-secondary dropdown-toggle dropdown-toggle-simple" data-toggle="dropdown" data-boundary="viewport">
                                    <svg class="svg-inline--fa fa-ellipsis-v fa-w-6 fa-fw" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="ellipsis-v" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg=""><path fill="currentColor" d="M96 184c39.8 0 72 32.2 72 72s-32.2 72-72 72-72-32.2-72-72 32.2-72 72-72zM24 80c0 39.8 32.2 72 72 72s72-32.2 72-72S135.8 8 96 8 24 40.2 24 80zm0 352c0 39.8 32.2 72 72 72s72-32.2 72-72-32.2-72-72-72-72 32.2-72 72z"></path></svg><!-- <i class="fa fa-fw fa-ellipsis-v"></i> Font Awesome fontawesome.com -->
                                </button>

                               
                            </div>
                        </div>
                    </td>
                </tr>
                            
                
                            
                
                            
                
                            
                
                            
                
                            
                
            
            </tbody>
        </table>
    </div>

    <div class="mt-3">

<div class="d-flex flex-column flex-lg-row justify-content-lg-between align-items-lg-center">
    <div class="text-center text-lg-left">
        <p class="text-muted mb-0">
            <strong>7</strong> destek talebi gösteriliyor.        </p>
    </div>

    </div>


</div>


<?php else: ?>
    <div class="d-flex flex-column align-items-center justify-content-center py-3 mt-5" >

    

<form name="create_notification" method="post" role="form" style="min-width: -webkit-fill-available;">
    
                    <input type="hidden" name="campaign_id" value="<?= $data->campaign->user_id ?>">
                    <input type="hidden" name="campaign_id" value="<?= $data->campaign->campaign_id ?>">
                    <input type="hidden" name="campaign_id" value="<?= $data->campaign->name ?>">
                    <input type="hidden" name="campaign_id" value="<?= $data->campaign->domain ?>">
                    <input type="hidden" name="campaign_id" value="<?= $data->campaign->pixel_key ?>">



<div>
    <ul class="nav nav-pills d-flex flex-fill flex-column flex-lg-row mb-3" role="tablist">
        <li class="nav-item flex-fill text-center" role="presentation">
            <a class="nav-link active" id="pro-genel-tab" data-toggle="pill" href="#pro-genel" role="tab" aria-controls="pro-home" aria-selected="true">Genel Ayarlar</a>
        </li>
        <li class="nav-item flex-fill text-center" role="presentation">
            <a class="nav-link" id="pro-genel-tab" data-toggle="pill" href="#pro-reklam" role="tab" aria-controls="pro-reklam" aria-selected="false">Toplu Ürün Ekleme</a>
        </li>
        <li class="nav-item flex-fill text-center" role="presentation">
            <a class="nav-link" id="pro-users-tab" data-toggle="pill" href="#pro-users" role="tab" aria-controls="pro-users" aria-selected="false">Push Bildirim Ayarları</a>
        </li>
        <li class="nav-item flex-fill text-center" role="presentation">
            <a class="nav-link" id="pro-users-tab" data-toggle="pill" href="#pro-users" role="tab" aria-controls="pro-users" aria-selected="false">E-Posta Ayarları</a>
        </li>
        <li class="nav-item flex-fill text-center" role="presentation">
            <a class="nav-link" id="pro-users-tab" data-toggle="pill" href="#pro-users" role="tab" aria-controls="pro-users" aria-selected="false">Entegrasyonlar</a>
        </li>
       
        
    </ul>

    <div class="tab-content" id="pro-tabContent">
        <div class="tab-pane fade active show" id="pro-genel" role="tabpanel" aria-labelledby="pro-genel-tab">
              

              Yakında

              
                   

        </div>

        <div class="tab-pane fade" id="pro-reklam" role="tabpanel" aria-labelledby="pro-reklam-tab">
             

             Yakında

               


        </div>
    </div>
</div>



                

                
                 
                    <div class="text-center mt-4">
                         <small class="form-text text-muted">Her bir özellik için ekstra ayarları buradan yapabilirsiniz. Eğer takıldığınız bir nokta olursa lütfen bizimle iletişime geçiniz. </small>
                    </div>
                </form>

    </div>
<?php endif ?>
