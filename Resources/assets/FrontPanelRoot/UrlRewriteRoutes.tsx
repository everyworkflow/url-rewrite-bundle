/*
 * @copyright EveryWorkflow. All rights reserved.
 */

// import {lazy} from "react";
// const HomePage = lazy(() => import("@EveryWorkflow/FrontendBundle/Page/HomePage"));

import FinalPage from "@EveryWorkflow/UrlRewriteBundle/Page/FinalPage";

export const UrlRewriteRoutes = [
    {
        path: '*',
        component: FinalPage
    },
];
