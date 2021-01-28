<?php
    require_once "Post.php";
    //dao
    class PostDAO {
        //データーベースへ接続メソッド
        public static function get_connection(){
            $dsn = 'mysql:host=localhost;dbname=sns';
            $username = 'root';
            $password = 'araki1123';
            $options = array(
                 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS,
                 PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',  
            );
            $dbh = new PDO($dsn, $username, $password, $options);
            return $dbh;
        }
        //データーベースから切断するメソッド
        public static function close_connection($dbh, $stmt){
            $dbh = null;
            $stmt = null;
            
        }
        //データーベースから全会員情報を取得するメソッド
        public static function get_all_posts(){
            try {
                $dbh = self::get_connection();
                $stmt = $dbh->query('select * from sns.sample order by id desc');
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Post');
                $posts = $stmt->fetchAll();
                
            } catch(PDOException $e) {
                
            }finally{
                self::close_connection($dbh, $stmt);
            }
            return $posts;
         }
        //データーベースに新規会員を登録するメソッド
        public static function insert($post){
            try{
                $dbh = self::get_connection();
                $stmt = $dbh->prepare('insert into sample (name,title,message,image) values (:name, :title, :message, :image)');
                $stmt->bindParam(':name', $post->name, PDO::PARAM_STR);
                $stmt->bindValue(':title',$post->title,PDO::PARAM_STR);
                $stmt->bindValue(':message',$post->message,PDO::PARAM_STR);
                $stmt->bindValue(':image',$post->image);
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Post');
                $stmt->execute();
                
            }catch(PDOException $e){
                
            }finally{
                self::close_connection($dbh, $stmt);
            }
        }
        
        //IDを指定して会員を削除するメソッド
        public static function delete($id){
            try{
                $dbh = self::get_connection();
                $stmt = $dbh->prepare('delete from sample where id = :id');
                $stmt->bindValue(':id',$id,PDO::PARAM_INT);
                $stmt->execute();
                
            }catch(PDOException $e){
                
            }finally{
                self::close_connection($dbh, $stmt);
            }
        }
        //IDを指定して一人の会員を抜き出すメソッド
        public static function get_post_by_id($id){
            try{
                $dbh = self::get_connection();
                $stmt = $dbh->prepare('select * from sample where id = :id');
                $stmt->bindValue(':id',$id,PDO::PARAM_INT);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Post');
                $post = $stmt->fetch();
            }catch(PDOException $e){
                
            }finally{
                self::close_connection($dbh, $stmt);
            }
            return $post;
        }
        //IDを指定して会員情報を変更するメソッド
        public static function update($id, $name, $title, $mes, $image_name){
            try{
                $dbh = self::get_connection();
                $stmt = $dbh->prepare('update sample set name= :name,title= :title, message= :message, image= :image where id= :id');
                $stmt->bindValue(':name',$name,PDO::PARAM_STR);
                $stmt->bindValue(':title',$title,PDO::PARAM_STR);
                $stmt->bindValue(':message',$mes,PDO::PARAM_STR);
                $stmt->bindValue(':image',$image_name);
                $stmt->bindValue(':id',$id,PDO::PARAM_INT);
                $stmt->execute();
            }catch(PDOException $e){
                
            }finally{
                self::close_connection($dbh, $stmt);
            }
        }
    
              // ファイルをアップロードするメソッド
    public function upload(){
        // ファイルを選択していれば
        if (!empty($_FILES['image']['name'])) {
            // ファイル名をユニーク化
            $image = uniqid(mt_rand(), true); 
            // アップロードされたファイルの拡張子を取得
            $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);
            $file = 'upload/'. $image;
        
            // uploadディレクトリにファイル保存
            move_uploaded_file($_FILES['image']['tmp_name'], $file);
            
            return $image;
        }else{
            return '';
        }
    }
}