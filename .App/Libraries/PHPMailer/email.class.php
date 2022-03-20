<?php
/**
 * @version 2.0.0
 * @author Marcus Bointon (Synchro/coolbru) phpmailer@synchromedia.co.uk
 * @author Jim Jagielski (jimjag) jimjag@gmail.com
 * @author Andy Prevost (codeworxtech) codeworxtech@users.sourceforge.net
 * @author Brent R. Matzelle (original founder)
 * @author N Maphiri propheticCoder@gmail.com
 */
namespace App\Libraries\PHPMailer;
include('src/Exception.php');
include('src/OAuth.php');
include('src/POP3.php');
include('src/SMTP.php');
include('src/PHPMailer.php');
use \PHPMailer\PHPMailer\PHPMailer;

class Email extends PHPMailer{
    
    /**
     * Set The Details Of The Sender
     * @param string $Username The Email Of The Sender
     * @param string $SenderName The Name Of The Sender
     * @param string $Password To Sender Email
     */
    public function From(string $Username,string $SenderName,string $Password): void{
        $this->$Username=$Username;
        $this->Password=$Password;
        $this->setFrom($this->$Username, $SenderName); //This is the email your form sends From
    }
    
    /**
     * Set The Details For The Recepient
     * @param $recepientEmail The Email Of The Receipient
     * @param $recepientName The Name Of The Receipient
     */
    public function To(string $recepientEmail,string $recepientName) : void{
        //Recipients
        $this->addAddress($recepientEmail, $recepientName); // Add a recipient address
    }
    
    /**
     * Prepare An Email
     */
    public function prepare() : void {
        //Server settings
        //$this->SMTPOptions=array('ssl'=>array('verify_peer'=>false,'verify_peer_name'=>false,'allow_self_signed'=>true));
        // Enable verbose debug output
        $this->SMTPDebug = 0;
        $this->isSMTP();                                              // Set mailer to use SMTP
        $this->Host = 'mail.tabernacle.tv';                 // Specify main and backup SMTP servers
        $this->SMTPAuth = true;                             // Enable SMTP authentication
        $this->SMTPSecure = 'TLS';                     // Enable TLS encryption, `ssl` also accepted
        $this->Port = 587;                                    // TCP port to connect to
        $this->isHTML(true);                             // Set email format to HTML
    }

    /**
     * Insert Messege To HTMLTemplate
     * @param string $messege The Messege To Insert
     * @param string $subject The Subject Of The Messege
     * @param string $templateDir The Dir To Find The Template Of HTML Email
     */
    public function insertBody(string $messege,string $subject,string $templateDir) : void{
        $this->Body= $messege;
        $this->Subject = $subject;
        $this->AltBody = $messege;
    }

}
?>