-- MySQL dump 10.13  Distrib 8.0.31, for macos12 (x86_64)
--
-- Host: localhost    Database: Fraccionamiento
-- ------------------------------------------------------
-- Server version	5.7.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping events for database 'Fraccionamiento'
--

--
-- Dumping routines for database 'Fraccionamiento'
--
/*!50003 DROP PROCEDURE IF EXISTS `DatosPerfil` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `DatosPerfil`(IN `idUser` INT)
BEGIN
select
	foto.RutaImagen_FP as Foto,
	dp.nombre_RP as Nombre,
    dp.ap_RP as Ap,
    dp.am_RP as Am,
    dp.fechaNacimiento_RP as FechaNacimiento,
    mail.nombreEmail_Email as Mail,
    tel.numeroTelefono_Telefono as Telefono    
from tbl_Usuario us
INNER JOIN tbl_Residente dp on us.idResidente=dp.idResidentePrimario
INNER JOIN tbl_cat_Email mail on dp.idEmail_RP=mail.idEmail
INNER JOIN tbl_cat_telefono tel on dp.idTelefono_RP= tel.idTelefono
INNER JOIN tbl_cat_FotoPerfil foto on dp.idImagen_RP= foto.idFotoPerfil
Where us.status_Usuario=1 && us.idUsuario=idUser;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `EditPerfil` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `EditPerfil`(IN `id` INT, IN `nombre` VARCHAR(50), IN `ap` VARCHAR(50), IN `am` VARCHAR(50), IN `fn` DATE, IN `correo` VARCHAR(50), IN `tel` VARCHAR(10))
BEGIN
	Declare IdDatosP int;
    Declare IdCorreo int;
    Declare IdTel int;
    
	set IdDatosP=(select idResidente from tbl_Usuario where idUsuario=id);
    Update tbl_Residente SET nombre_RP=nombre, ap_RP=ap, am_RP=am, fechaNacimiento_RP=fn WHERE idResidentePrimario=IdDatosP;
    set IdCorreo=(select idEmail_RP from tbl_Residente where idResidentePrimario=IdDatosP);
    UPDATE tbl_cat_Email SET nombreEmail_Email=correo WHERE idEmail=IdCorreo && status=1;
    set IdTel=(select idTelefono_RP from tbl_Residente where idResidentePrimario=IdDatosP);
    UPDATE tbl_cat_telefono SET numeroTelefono_Telefono=tel WHERE idTelefono=IdTel && status=1;
    
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ValidateUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ValidateUser`(IN `usuario` VARCHAR(50), IN `pass` VARCHAR(50))
BEGIN
select
	us.idUsuario as IdUsuario,
    UPPER(CONCAT(dp.nombre_RP," ",dp.ap_RP," ",dp.am_RP)) as Nombre,
    cargo.nombre_TU as Cargo,
    foto.RutaImagen_FP as Foto
from tbl_Usuario us
INNER JOIN tbl_Residente dp on us.idResidente=dp.idResidentePrimario
INNER JOIN tbl_cat_TipoUsuario cargo on us.idTipoUsuario_Usuario=cargo.idTipoUsuario
INNER JOIN tbl_cat_FotoPerfil foto on dp.idImagen_RP=foto.idFotoPerfil
Where us.status_Usuario=1 && us.usuario_Usuario=usuario && us.password_Usuario=pass;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-09-11 19:04:05
