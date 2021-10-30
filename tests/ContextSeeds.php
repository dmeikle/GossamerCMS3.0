<?php

namespace tests;

class ContextSeeds
{
     const BASE_USER_ID = "d73cc933-0331-42ba-a631-9a470ad13731";
     const BASE_ORGANIZATION_ID = "b90beaba-22c2-454f-90ce-0c89764c3c86";
     const BASE_USERENTITY_ID = "5f739dbb-59da-483d-b230-ec64307ba90e";
     const BASE_UPDATABLE_USER_ID = "999a19d0-404f-4bb3-b164-d50f2cdd855b";
     const BASE_ORGANIZATIONENTITY_ID = "2ebe5bb9-7d4b-437f-83e0-5a05c9359959";
     const BASE_USEREMAIL_ID = "2163b6bc-6563-4621-bd68-4cb553e2663d";
     const BASE_USERADDRESS_ID = "ff7a1514-dc70-4d45-a1fe-1ce7c0b0d055";
     const BASE_ORGANIZATIONEMAIL_ID = "02d95221-8c94-4cb7-8df7-402048097bac";
     const BASE_ORGANIZATIONADDRESS_ID = "362c7284-60bf-4e43-956b-26c524cb3a0f";
     const BASE_USER_NO_ENTITY_ID = "5b97400b-9a39-47eb-b044-22ac3108f67e";
     const BASE_LEGAL_SUBDIVISION_ID = "5b6a693c-d28c-466b-922f-ef73a7b208a0";
     const BASE_SURVEY_TEMPLATE_ID = "c70202d0-e36f-459b-a3ee-32ca13e25c5c";
     const BASE_SURVEY_ID = "a3422f55-982d-4632-affa-859c5d965594";
     const BASE_SURVEY_QUESTION_ID = "35f516bb-7027-4382-979f-43260fcf6575";
     const BASE_SURVEY_ANSWER_ID = "22f68464-14de-46ef-9800-f0c7191b1d89";

//    public static List<MappedEntity> getEntities() {
//        return new ArrayList<MappedEntity>(){{
//            add(new MappedEntity(BASE_USERENTITY_ID, BASE_USER_ID, EntityType.USER));
//            add(new MappedEntity(BASE_ORGANIZATIONENTITY_ID, BASE_ORGANIZATION_ID, EntityType.ORGANIZATION));
//        }};
//}

    public static function getUsers() : array
    {
        return array(
            new User(self::BASE_USER_ID, "user-firstname", "user-lastname", new Date(), new Date())
        );
    }

//    public static List<Organization> getOrganizations() {
//        return new ArrayList<Organization>() {{
//            add(new Organization(BASE_ORGANIZATION_ID, "org-name", new Date(), new Date()));
//        }};
//    }
//
//    public static List<EntityAddress> getAddresses() {
//        return new ArrayList<EntityAddress>() {{
//            add(new EntityAddress(
//                BASE_ORGANIZATIONADDRESS_ID,
//                BASE_ORGANIZATIONENTITY_ID,
//                AddressType.OFFICE,
//                "address-1",
//                "address-2",
//                "Mesa",
//                "AZ",
//                "US",
//                "85201",
//                true,
//                true,
//                43.123,
//                -123.123,
//                new Date(),
//                new Date()
//            ));
//            add(new EntityAddress(
//                BASE_USERADDRESS_ID,
//                BASE_USERENTITY_ID,
//                AddressType.RESIDENCE,
//                "address-1",
//                "address-2",
//                "Mesa",
//                "AZ",
//                "US",
//                "85201",
//                true,
//                true,
//                43.123,
//                -123.123,
//                new Date(),
//                new Date()
//            ));
//        }};
//    }
}