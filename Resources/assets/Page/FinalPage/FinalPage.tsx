/*
 * @copyright EveryWorkflow. All rights reserved.
 */

import React, {useEffect, useState} from 'react';
import Error404Component from "@EveryWorkflow/CoreBundle/Component/Error404Component";
import Remote from "@EveryWorkflow/CoreBundle/Service/Remote";
import {useHistory} from "react-router-dom";
import PageBuilderComponent from "@EveryWorkflow/PageBuilderBundle/Component/PageBuilderComponent";
import {useTitle} from "ahooks";
import LoadingIndicatorComponent from "@EveryWorkflow/CoreBundle/Component/LoadingIndicatorComponent";

const FinalPage = () => {
    const [data, setData] = useState<any>(undefined);
    const history = useHistory();

    useEffect(() => {
        const run = async () => {
            let pathName = history.location.pathname;
            if (pathName === '/') {
                pathName = '/home';
            }
            try {
                const response = await Remote.get(`/url-rewrite${pathName}`);
                setData(response);
            } catch (error: any) {
                console.log('error -->', error.message);
                setData(false);
            }
        }
        run();
    }, [history.location.pathname]);

    const RenderPageContent = () => {
        if (data.meta_title) {
            useTitle(data.meta_title.toString());
        }
        return (
            <>
                {(data && !!data.page_builder_data) ? (
                    <PageBuilderComponent pageBuilderData={data.page_builder_data}/>
                ) : <Error404Component/>}
            </>
        );
    }

    return (
        <>
            {(data !== undefined) ? (
                <RenderPageContent/>
            ) : <LoadingIndicatorComponent/>}
        </>
    );
}

export default FinalPage;
