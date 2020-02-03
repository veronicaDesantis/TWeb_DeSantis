<?php
/**
 * Class User
 * 
 * Viene utilizzata come una classe di utility. Senza importazioni esterne perchè vengono fatte nelle classi principali
 */
class User
    {
        /**
         * Creazione nuovo user
         * 
         * @param mixed $nome
         * @param mixed $cognome
         * @param mixed $username
         * @param mixed $hashedPassword
         * @param mixed $mail
         * @param mixed $path_foto
         * 
         * @return void
         */
        public function CreateNewUser($nome, $cognome, $username, $hashedPassword, $mail, $path_foto)
        {
            $qry = new Query;
            return $qry->CreateNewUser($nome, $cognome, $username, $hashedPassword, $mail, $path_foto);
        }

        /**
         * Aggiornamento user
         * 
         * @param mixed $nome
         * @param mixed $cognome
         * @param mixed $username
         * @param mixed $path_foto
         * @param mixed $bio
         * @param mixed $id_utente
         * 
         * @return void
         */
        public function UpdateUser($nome, $cognome, $username, $path_foto, $bio, $id_utente)
        {
            $qry = new Query;
            $qry->UpdateUser($nome, $cognome, $username, $path_foto, $bio, $id_utente);
        }

        /**
         * Aggiorna password singolo utente
         * 
         * @param mixed $hashedPassword
         * @param mixed $id_usente
         * 
         * @return void
         */
        public function UpdatePassword($hashedPassword, $id_usente)
        {
            $qry = new Query;
            $qry->UpdatePassword($hashedPassword, $id_usente);
        }
        /**
         * Seleziona un utente
         * 
         * @return void
         */
        public function GetUser()
        {
            $qry = new Query;
            return $qry->GetUser();
        }

        /**
         * Selezione l'id dell'utente
         * 
         * @return void
         */
        public function GetIdUtente()
        {
            $first_row = $this->GetUser();
            return $first_row['id_utente'];
        }

        /**
         * Seleziona lo username dell'utente
         * 
         * @return void
         */
        public function GetUsername()
        {
            $first_row = $this->GetUser();
            return $first_row['username'];
        }

        /**
         * Seleziona la BIO dell'utente
         * 
         * @return void
         */
        public function GetBio()
        {
            $first_row = $this->GetUser();
            return $first_row['bio'];
        }

        /**
         * Seleziona la mail dell'utente
         * 
         * @return void
         */
        public function GetMail()
        {
            $first_row = $this->GetUser();
            return $first_row['mail'];
        }

        /**
         * Seleziona il cognome dell'utente
         * 
         * @return void
         */
        public function GetCognome()
        {
            $first_row = $this->GetUser();
            return $first_row['cognome'];
        }

        /**
         * Seleziona il nome dell'utente
         * 
         * @return void
         */
        public function GetNome()
        {
            $first_row = $this->GetUser();
            return $first_row['nome'];
        } 

        /**
         * Seleziona nome e cognome dell'utente
         * 
         * @return void
         */
        public function GetNomeCompleto()
        {
            return $this->GetNome(). " ". $this->GetCognome();
        }

        /**
         * Seleziona il path della foto utente
         * 
         * @return void
         */
        public function GetPathPhoto()
        {
            $first_row = $this->GetUser();
            return $first_row['path_foto'];
        } 

        /**
         * Seleziona l'utente dal login
         * 
         * @param mixed $mail
         * @param mixed $hashedPassword
         * 
         * @return void
         */
        public function GetUserByLogin($mail, $hashedPassword)
        {
            $qry = new Query;
            return $qry->GetUserByLogin($mail, $hashedPassword);
        }

        /**
         * Seleziona l'utente con stesso username e mail
         * 
         * @param mixed $username
         * @param mixed $mail
         * 
         * @return void
         */
        public function GetUserByNomeMail($username, $mail)
        {
            $qry = new Query;
            return $qry->GetUserByNomeMail($username, $mail);
        }

        /**
         * Seleziona l'utente dall'id
         * 
         * @param mixed $id_utente
         * 
         * @return void
         */
        public function GetUserById($id_utente)
        {
            $qry = new Query;
            return $qry->GetUserById($id_utente);
        }

        /**
         * @param mixed $id_utente
         * @param mixed $path
         * 
         * @return void
         */
        public function GetUserByIdPath($id_utente, $path)
        {
            $qry = new Query;
            return $qry->GetUserByIdPath($id_utente, $path);
        }
    }
?>