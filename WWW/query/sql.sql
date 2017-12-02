/**
 * @Author: Miroslav Karpíšek <miro>
 * @Date:   28-11-2017
 * @Email:  karpisek.m@email.cz
 * @Project: IFJ
 * @Last modified by:   miro
 * @Last modified time: 28-11-2017
 */

 START TRANSACTION
 BEGIN;
 SELECT *
         FROM Zvire
         NATURAL JOIN Druh

 COMMIT;
