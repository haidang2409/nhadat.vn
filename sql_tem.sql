SELECT *
FROM `nhadat`.`members` AS `Member`
WHERE (
  (`Member`.`username` = 'abcabc')
  OR
  (`Member`.`phonenumber` = 'abcabc')
  OR (`Member`.`email` = 'abcabc')
  )
   AND `Member`.`password` = '976cdcdfde878d0b3557df5f22104c9387b2f917' LIMIT 1