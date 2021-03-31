<?php


namespace App\Manager;


use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\Security;

class EmailManager
{

    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var Security
     */
    private $security;

    public function __construct(MailerInterface $mailer, Security $security)
    {
        $this->mailer = $mailer;
        $this->security = $security;
    }

    public function sendMailAdmin($room)
    {
        $mail = (new TemplatedEmail())
            ->from('no-reply@louetasalle.fr')
            ->to($this->security->getUser()->getUsername())
            ->subject('[Admin] Une nouvelle salle à été ajoutée')
            ->htmlTemplate('mail/newRoom.html.twig')
            ->context([
                'room'=>$room
            ]);

        $this->mailer->send($mail);
     }
}