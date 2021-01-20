<?php
    require_once "human.php";
    //dao
    class HumanDAO {
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
        public static function get_all_humans(){
            try {
                $dbh = self::get_connection();
                $stmt = $dbh->query('select * from sns.sample order by id desc');
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Human');
                $humans = $stmt->fetchAll();
                
            } catch(PDOException $e) {
            }finally{
                self::close_connection($dbh, $stmt);
            }
            return $humans;
         }
        //データーベースに新規会員を登録するメソッド
        public static function insert($human){
            try{
                $dbh = self::get_connection();
                $stmt = $dbh->prepare('insert into sample (name,title,message,image) values (:name, :title, :message, :image)');
                $stmt->bindParam(':name', $human->name, PDO::PARAM_STR);
                $stmt->bindValue(':title',$human->title,PDO::PARAM_STR);
                $stmt->bindValue(':message',$human->message,PDO::PARAM_STR);
                $stmt->bindValue(':image',$human->image);
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Human');
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
        public static function get_human_by_id($id){
            try{
                $dbh = self::get_connection();
                $stmt = $dbh->prepare('select * from sample where id = :id');
                $code = $_GET['id'];
                $stmt->bindValue(':id',$code,PDO::PARAM_INT);
                $stmt->execute();
                $human = $stmt->fetch(PDO::FETCH_ASSOC);
                $id = $human['id'];
                $image = $human['image'];
                    print "<ul>";
                    print "<li>名前 : {$human['name']}</li>";
                    print "<li>投稿日時 : {$human['created_at']}</li>";
                    print "<li>タイトル : {$human['title']}</li>";
                    print "<li>内容 : {$human['message']}</li>";
                    print "<li>画像：<br/>";
                    move_uploaded_file($image['tmp_name'],'./img'.$image['name']);
                    print '<img src="./img/'.$image['name'].'">';
                    print '<br/>';
    
                    print "<ul>";
                    print "<a href='edit.php?id=$id'>編集</a> <a href='delete.php?id=$id'>削除</a>";
                
                
            }catch(PDOException $e){
                
            }finally{
                self::close_connection($dbh, $stmt);
                
            }
            return $human;
        }
        //IDを指定して会員情報を変更するメソッド
        public static function update($id, $name, $title,$mes,$image){
            try{
                $dbh = self::get_connection();
                $stmt = $dbh->prepare('update sample set name= :name,title= :title, message= :message, image= :image where id= :id');
                $stmt->bindValue(':name',$name,PDO::PARAM_STR);
                $stmt->bindValue(':title',$title,PDO::PARAM_INT);
                $stmt->bindValue(':message',$mes,PDO::PARAM_INT);
                $stmt->bindValue(':image',$image);
                
                $stmt->bindValue(':id',$id,PDO::PARAM_INT);
                $stmt->execute();
                
                
            }catch(PDOException $e){
                
            }finally{
                self::close_connection($dbh, $stmt);
                
            }
        }
        //IDを指定して会員情報を変更する画面
        public static function start_update($id){
            try{
                $dbh = self::get_connection();
                $stmt = $dbh->prepare('select * from sample where id = :id');
                $stmt->bindValue(':id',$id,PDO::PARAM_INT);
                $stmt->execute();
                
                $human = $stmt->fetch(PDO::FETCH_ASSOC);
                
                print "<form action='edit.done.php' method='post' enctype='multipart/form-data'>";
                print "名前<br/><input type='text' name='name' value='{$human['name']}'><br/>";
                print "タイトル<br/><input type='text' name='title' value='{$human['title']}'><br/>";
                print "メッセージ<br/><input type='text' name='message' value='{$human['message']}'><br/>";
                print "画像<br/><input type='file' name='image' value='{$human['image']}'><br/>";
                print "<input type='hidden' name='id' value='{$human['id']}'>";
                print "<input type='button' onclick='history.back()' value='戻る'>&emsp;";   
                print "<input type='submit' value='更新'>";    
                print "</form>";    
                
                
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
            return null;
        }
    }
}