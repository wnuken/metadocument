<?php
/*
* author: Brisan
* app: backQBC
*/
class Querys {

    var $error = array(
        'NO_FOUND' => 'Value no found: ',
        'EMPTY' => 'Value is empty'
    );


    private function ErrorMessage($params){
        var_dump($params);
        die();
    }

    public function CouponMappingByIncrementId($params){
        try{
            if($params['one'] == 1){
                $result = CouponMappingQuery::create()->findOneByIncrementId($params['id']);
            }else{
                $result = CouponMappingQuery::create()->findByIncrementId($params['id']);
            }
            if(empty($result)){
                $result = $this->error['NO_FOUND'] . json_encode($params['id']);
                $this->ErrorMessage($result);
            }
        }catch (Exception $e){
            $result = $this->exception . $e->getMessage(). "\n";
            $this->ErrorMessage($result);
        }
        return $result;
    }

    public function SalesFlatOrderByEntityId($params){
        try{
            $result = SalesFlatOrderQuery::create()->findOneByEntityId($params['id']);
            if(empty($result)){
                $result = $this->error['NO_FOUND'] . $params['id'];
                $this->ErrorMessage($result);
            }
        }catch (Exception $e){
            $result = $this->exception .  $e->getMessage(). "\n";
            $this->ErrorMessage($result);
        }
        return $result;
    }

    public function SalesFlatOrderByIncrementId($params){
        try{
            if($params['one'] == 1){
                $result = SalesFlatOrderQuery::create()->findOneByIncrementId($params['id']);
            }else{
                $result = SalesFlatOrderQuery::create()->findByIncrementId($params['id']);
            }
            if(empty($result)){
                $result = $this->error['NO_FOUND'] . $params['id'];
                $this->ErrorMessage($result);
            }
        }catch (Exception $e){
            $result = $this->exception .  $e->getMessage(). "\n";
            $this->ErrorMessage($result);
        }
        return $result;
    }
    
    public function AdminUserByUser($params){
        try{           
            $result = AdminUserQuery::create()->findOneByUser($params['user']);
            // var_dump($result);
            if(empty($result)){
                $result = array(
                    'message' => $this->error['NO_FOUND'] . json_encode($params['user']),
                    'status' => false
                );
                return $result;
            }
        }catch (Exception $e){
            $result = $this->exception . $e->getMessage(). "\n";
            $this->ErrorMessage($result);
        }
        return $result;
    }

    public function FolderMetadataFormbyFolderId($params){
        try{           
            $result = FolderMetadataFormQuery::create()->findOneByFolderId($params['id']);
            // var_dump($result);
            if(empty($result)){
                $result = array(
                    'message' => $this->error['NO_FOUND'] . json_encode($params['id']),
                    'status' => false
                );
                return $result;
            }
        }catch (Exception $e){
            $result = $this->exception . $e->getMessage(). "\n";
            $this->ErrorMessage($result);
        }
        return $result;
    }

    public function DocumentMetadatabyDocumentId($params){
        try{           
            $result = DocumentMetadataQuery::create()->findOneByDocumentId($params['id']);
            // var_dump($result);
            if(empty($result)){
                $result = array(
                    'message' => $this->error['NO_FOUND'] . json_encode($params['id']),
                    'status' => false
                );
                return $result;
            }
        }catch (Exception $e){
            $result = $this->exception . $e->getMessage(). "\n";
            $this->ErrorMessage($result);
        }
        return $result;
    }

}

