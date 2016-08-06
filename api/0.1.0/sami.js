
(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:Klaviyo" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Klaviyo.html">Klaviyo</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Klaviyo_Exception" >                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Klaviyo/Exception.html">Exception</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Klaviyo_Exception_ApiConnectionException" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Exception/ApiConnectionException.html">ApiConnectionException</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Exception_ApiException" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Exception/ApiException.html">ApiException</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Exception_BadRequestApiException" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Exception/BadRequestApiException.html">BadRequestApiException</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Exception_CannotDeleteRequiredSpecialAttributeKeyException" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Exception/CannotDeleteRequiredSpecialAttributeKeyException.html">CannotDeleteRequiredSpecialAttributeKeyException</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Exception_InvalidSpecialAttributeKeyException" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Exception/InvalidSpecialAttributeKeyException.html">InvalidSpecialAttributeKeyException</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Exception_IsNotAServiceException" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Exception/IsNotAServiceException.html">IsNotAServiceException</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Exception_KlaviyoExceptionInterface" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Exception/KlaviyoExceptionInterface.html">KlaviyoExceptionInterface</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Exception_MissingModelTypeException" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Exception/MissingModelTypeException.html">MissingModelTypeException</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Exception_NotAuthorizedApiException" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Exception/NotAuthorizedApiException.html">NotAuthorizedApiException</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Exception_NotFoundApiException" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Exception/NotFoundApiException.html">NotFoundApiException</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Exception_ServerErrorApiException" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Exception/ServerErrorApiException.html">ServerErrorApiException</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Exception_ServiceNotFoundException" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Exception/ServiceNotFoundException.html">ServiceNotFoundException</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Klaviyo_Model" >                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Klaviyo/Model.html">Model</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Klaviyo_Model_BaseModel" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Model/BaseModel.html">BaseModel</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Model_CampaignModel" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Model/CampaignModel.html">CampaignModel</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Model_EmptyModel" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Model/EmptyModel.html">EmptyModel</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Model_ListModel" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Model/ListModel.html">ListModel</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Model_ListReferenceModel" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Model/ListReferenceModel.html">ListReferenceModel</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Model_MembershipModel" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Model/MembershipModel.html">MembershipModel</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Model_ModelFactory" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Model/ModelFactory.html">ModelFactory</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Model_ModelInterface" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Model/ModelInterface.html">ModelInterface</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Model_PageModel" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Model/PageModel.html">PageModel</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Model_PersonListModel" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Model/PersonListModel.html">PersonListModel</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Model_PersonModel" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Model/PersonModel.html">PersonModel</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Model_PersonReferenceModel" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Model/PersonReferenceModel.html">PersonReferenceModel</a>                    </div>                </li>                            <li data-name="class:Klaviyo_Model_TemplateModel" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Klaviyo/Model/TemplateModel.html">TemplateModel</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:Klaviyo_BaseService" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Klaviyo/BaseService.html">BaseService</a>                    </div>                </li>                            <li data-name="class:Klaviyo_CampaignService" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Klaviyo/CampaignService.html">CampaignService</a>                    </div>                </li>                            <li data-name="class:Klaviyo_KlaviyoApi" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Klaviyo/KlaviyoApi.html">KlaviyoApi</a>                    </div>                </li>                            <li data-name="class:Klaviyo_KlaviyoFacade" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Klaviyo/KlaviyoFacade.html">KlaviyoFacade</a>                    </div>                </li>                            <li data-name="class:Klaviyo_KlaviyoProvider" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Klaviyo/KlaviyoProvider.html">KlaviyoProvider</a>                    </div>                </li>                            <li data-name="class:Klaviyo_ListService" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Klaviyo/ListService.html">ListService</a>                    </div>                </li>                            <li data-name="class:Klaviyo_PagerTrait" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Klaviyo/PagerTrait.html">PagerTrait</a>                    </div>                </li>                            <li data-name="class:Klaviyo_PersonService" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Klaviyo/PersonService.html">PersonService</a>                    </div>                </li>                            <li data-name="class:Klaviyo_ServiceInterface" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Klaviyo/ServiceInterface.html">ServiceInterface</a>                    </div>                </li>                            <li data-name="class:Klaviyo_TrackService" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Klaviyo/TrackService.html">TrackService</a>                    </div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "Klaviyo.html", "name": "Klaviyo", "doc": "Namespace Klaviyo"},{"type": "Namespace", "link": "Klaviyo/Exception.html", "name": "Klaviyo\\Exception", "doc": "Namespace Klaviyo\\Exception"},{"type": "Namespace", "link": "Klaviyo/Model.html", "name": "Klaviyo\\Model", "doc": "Namespace Klaviyo\\Model"},
            {"type": "Interface", "fromName": "Klaviyo\\Exception", "fromLink": "Klaviyo/Exception.html", "link": "Klaviyo/Exception/KlaviyoExceptionInterface.html", "name": "Klaviyo\\Exception\\KlaviyoExceptionInterface", "doc": "&quot;Simple Exception interface all Klavio exceptions should implement.&quot;"},
                    
            {"type": "Interface", "fromName": "Klaviyo\\Model", "fromLink": "Klaviyo/Model.html", "link": "Klaviyo/Model/ModelInterface.html", "name": "Klaviyo\\Model\\ModelInterface", "doc": "&quot;The base Klaviyo data model.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\Model\\ModelInterface", "fromLink": "Klaviyo/Model/ModelInterface.html", "link": "Klaviyo/Model/ModelInterface.html#method_create", "name": "Klaviyo\\Model\\ModelInterface::create", "doc": "&quot;Helper method to create the data model.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\ModelInterface", "fromLink": "Klaviyo/Model/ModelInterface.html", "link": "Klaviyo/Model/ModelInterface.html#method_createFromJson", "name": "Klaviyo\\Model\\ModelInterface::createFromJson", "doc": "&quot;Helper method to create the data model from a JSON array.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\ModelInterface", "fromLink": "Klaviyo/Model/ModelInterface.html", "link": "Klaviyo/Model/ModelInterface.html#method_toArray", "name": "Klaviyo\\Model\\ModelInterface::toArray", "doc": "&quot;Convert the model to an array.&quot;"},
            
            {"type": "Interface", "fromName": "Klaviyo", "fromLink": "Klaviyo.html", "link": "Klaviyo/ServiceInterface.html", "name": "Klaviyo\\ServiceInterface", "doc": "&quot;The base manager class used handle models transmission to and from the API.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\ServiceInterface", "fromLink": "Klaviyo/ServiceInterface.html", "link": "Klaviyo/ServiceInterface.html#method_create", "name": "Klaviyo\\ServiceInterface::create", "doc": "&quot;Instantiates a new instance of this class.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\ServiceInterface", "fromLink": "Klaviyo/ServiceInterface.html", "link": "Klaviyo/ServiceInterface.html#method_getResourcePath", "name": "Klaviyo\\ServiceInterface::getResourcePath", "doc": "&quot;Retrieve the full resource path.&quot;"},
            
            
            {"type": "Class", "fromName": "Klaviyo", "fromLink": "Klaviyo.html", "link": "Klaviyo/BaseService.html", "name": "Klaviyo\\BaseService", "doc": "&quot;The base manager class used handle models transmission to and from the API.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\BaseService", "fromLink": "Klaviyo/BaseService.html", "link": "Klaviyo/BaseService.html#method___construct", "name": "Klaviyo\\BaseService::__construct", "doc": "&quot;The constructor for the list manager class.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\BaseService", "fromLink": "Klaviyo/BaseService.html", "link": "Klaviyo/BaseService.html#method_create", "name": "Klaviyo\\BaseService::create", "doc": "&quot;Instantiates a new instance of this class.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\BaseService", "fromLink": "Klaviyo/BaseService.html", "link": "Klaviyo/BaseService.html#method_getResourcePath", "name": "Klaviyo\\BaseService::getResourcePath", "doc": "&quot;Retrieve the full resource path.&quot;"},
            
            {"type": "Class", "fromName": "Klaviyo\\Exception", "fromLink": "Klaviyo/Exception.html", "link": "Klaviyo/Exception/ApiConnectionException.html", "name": "Klaviyo\\Exception\\ApiConnectionException", "doc": "&quot;Simple Exception for Klaviyo API.&quot;"},
                    
            {"type": "Class", "fromName": "Klaviyo\\Exception", "fromLink": "Klaviyo/Exception.html", "link": "Klaviyo/Exception/ApiException.html", "name": "Klaviyo\\Exception\\ApiException", "doc": "&quot;Simple Exception for Klaviyo API.&quot;"},
                    
            {"type": "Class", "fromName": "Klaviyo\\Exception", "fromLink": "Klaviyo/Exception.html", "link": "Klaviyo/Exception/BadRequestApiException.html", "name": "Klaviyo\\Exception\\BadRequestApiException", "doc": "&quot;Simple Exception for Klaviyo API.&quot;"},
                    
            {"type": "Class", "fromName": "Klaviyo\\Exception", "fromLink": "Klaviyo/Exception.html", "link": "Klaviyo/Exception/CannotDeleteRequiredSpecialAttributeKeyException.html", "name": "Klaviyo\\Exception\\CannotDeleteRequiredSpecialAttributeKeyException", "doc": "&quot;Simple Exception for Klaviyo API.&quot;"},
                    
            {"type": "Class", "fromName": "Klaviyo\\Exception", "fromLink": "Klaviyo/Exception.html", "link": "Klaviyo/Exception/InvalidSpecialAttributeKeyException.html", "name": "Klaviyo\\Exception\\InvalidSpecialAttributeKeyException", "doc": "&quot;Simple Exception for Klaviyo API.&quot;"},
                    
            {"type": "Class", "fromName": "Klaviyo\\Exception", "fromLink": "Klaviyo/Exception.html", "link": "Klaviyo/Exception/IsNotAServiceException.html", "name": "Klaviyo\\Exception\\IsNotAServiceException", "doc": "&quot;Simple Exception for Klaviyo API.&quot;"},
                    
            {"type": "Class", "fromName": "Klaviyo\\Exception", "fromLink": "Klaviyo/Exception.html", "link": "Klaviyo/Exception/KlaviyoExceptionInterface.html", "name": "Klaviyo\\Exception\\KlaviyoExceptionInterface", "doc": "&quot;Simple Exception interface all Klavio exceptions should implement.&quot;"},
                    
            {"type": "Class", "fromName": "Klaviyo\\Exception", "fromLink": "Klaviyo/Exception.html", "link": "Klaviyo/Exception/MissingModelTypeException.html", "name": "Klaviyo\\Exception\\MissingModelTypeException", "doc": "&quot;Simple Exception for Klaviyo API.&quot;"},
                    
            {"type": "Class", "fromName": "Klaviyo\\Exception", "fromLink": "Klaviyo/Exception.html", "link": "Klaviyo/Exception/NotAuthorizedApiException.html", "name": "Klaviyo\\Exception\\NotAuthorizedApiException", "doc": "&quot;Simple Exception for Klaviyo API.&quot;"},
                    
            {"type": "Class", "fromName": "Klaviyo\\Exception", "fromLink": "Klaviyo/Exception.html", "link": "Klaviyo/Exception/NotFoundApiException.html", "name": "Klaviyo\\Exception\\NotFoundApiException", "doc": "&quot;Simple Exception for Klaviyo API.&quot;"},
                    
            {"type": "Class", "fromName": "Klaviyo\\Exception", "fromLink": "Klaviyo/Exception.html", "link": "Klaviyo/Exception/ServerErrorApiException.html", "name": "Klaviyo\\Exception\\ServerErrorApiException", "doc": "&quot;Simple Exception for Klaviyo API.&quot;"},
                    
            {"type": "Class", "fromName": "Klaviyo\\Exception", "fromLink": "Klaviyo/Exception.html", "link": "Klaviyo/Exception/ServiceNotFoundException.html", "name": "Klaviyo\\Exception\\ServiceNotFoundException", "doc": "&quot;Simple Exception for Klaviyo API.&quot;"},
                    
            {"type": "Class", "fromName": "Klaviyo", "fromLink": "Klaviyo.html", "link": "Klaviyo/KlaviyoApi.html", "name": "Klaviyo\\KlaviyoApi", "doc": "&quot;The main Klaviyo API class for communicating with the Klaviyo API.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\KlaviyoApi", "fromLink": "Klaviyo/KlaviyoApi.html", "link": "Klaviyo/KlaviyoApi.html#method___construct", "name": "Klaviyo\\KlaviyoApi::__construct", "doc": "&quot;The constructor for KlaviyoApi.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\KlaviyoApi", "fromLink": "Klaviyo/KlaviyoApi.html", "link": "Klaviyo/KlaviyoApi.html#method_create", "name": "Klaviyo\\KlaviyoApi::create", "doc": "&quot;Helper method for creating a new API object.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\KlaviyoApi", "fromLink": "Klaviyo/KlaviyoApi.html", "link": "Klaviyo/KlaviyoApi.html#method_getOption", "name": "Klaviyo\\KlaviyoApi::getOption", "doc": "&quot;Retrieve a specific option.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\KlaviyoApi", "fromLink": "Klaviyo/KlaviyoApi.html", "link": "Klaviyo/KlaviyoApi.html#method_setOption", "name": "Klaviyo\\KlaviyoApi::setOption", "doc": "&quot;Set a specific option.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\KlaviyoApi", "fromLink": "Klaviyo/KlaviyoApi.html", "link": "Klaviyo/KlaviyoApi.html#method_getAllOptions", "name": "Klaviyo\\KlaviyoApi::getAllOptions", "doc": "&quot;Retrieve an an array of all available options.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\KlaviyoApi", "fromLink": "Klaviyo/KlaviyoApi.html", "link": "Klaviyo/KlaviyoApi.html#method_request", "name": "Klaviyo\\KlaviyoApi::request", "doc": "&quot;Perform a request against the API.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\KlaviyoApi", "fromLink": "Klaviyo/KlaviyoApi.html", "link": "Klaviyo/KlaviyoApi.html#method_prepareRequestOptions", "name": "Klaviyo\\KlaviyoApi::prepareRequestOptions", "doc": "&quot;Prepare the options array before use in the request.&quot;"},
            
            {"type": "Class", "fromName": "Klaviyo", "fromLink": "Klaviyo.html", "link": "Klaviyo/KlaviyoFacade.html", "name": "Klaviyo\\KlaviyoFacade", "doc": "&quot;The Klaviyo API service container, model, and api wrapper.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\KlaviyoFacade", "fromLink": "Klaviyo/KlaviyoFacade.html", "link": "Klaviyo/KlaviyoFacade.html#method___construct", "name": "Klaviyo\\KlaviyoFacade::__construct", "doc": "&quot;The service container constructor.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\KlaviyoFacade", "fromLink": "Klaviyo/KlaviyoFacade.html", "link": "Klaviyo/KlaviyoFacade.html#method_create", "name": "Klaviyo\\KlaviyoFacade::create", "doc": "&quot;Factory method to create a new service continer.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\KlaviyoFacade", "fromLink": "Klaviyo/KlaviyoFacade.html", "link": "Klaviyo/KlaviyoFacade.html#method_getContainer", "name": "Klaviyo\\KlaviyoFacade::getContainer", "doc": "&quot;Retrieve the container.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\KlaviyoFacade", "fromLink": "Klaviyo/KlaviyoFacade.html", "link": "Klaviyo/KlaviyoFacade.html#method_service", "name": "Klaviyo\\KlaviyoFacade::service", "doc": "&quot;Retrieve a service from the service container.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\KlaviyoFacade", "fromLink": "Klaviyo/KlaviyoFacade.html", "link": "Klaviyo/KlaviyoFacade.html#method_model", "name": "Klaviyo\\KlaviyoFacade::model", "doc": "&quot;The model factory wrapper method.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\KlaviyoFacade", "fromLink": "Klaviyo/KlaviyoFacade.html", "link": "Klaviyo/KlaviyoFacade.html#method_modelFromJson", "name": "Klaviyo\\KlaviyoFacade::modelFromJson", "doc": "&quot;The create from json model factory wrapper method.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\KlaviyoFacade", "fromLink": "Klaviyo/KlaviyoFacade.html", "link": "Klaviyo/KlaviyoFacade.html#method_getModelClass", "name": "Klaviyo\\KlaviyoFacade::getModelClass", "doc": "&quot;Retrieve the model class of the specified model.&quot;"},
            
            {"type": "Class", "fromName": "Klaviyo", "fromLink": "Klaviyo.html", "link": "Klaviyo/KlaviyoProvider.html", "name": "Klaviyo\\KlaviyoProvider", "doc": "&quot;The Klaviyo api service container.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\KlaviyoProvider", "fromLink": "Klaviyo/KlaviyoProvider.html", "link": "Klaviyo/KlaviyoProvider.html#method___construct", "name": "Klaviyo\\KlaviyoProvider::__construct", "doc": "&quot;Provider constructor.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\KlaviyoProvider", "fromLink": "Klaviyo/KlaviyoProvider.html", "link": "Klaviyo/KlaviyoProvider.html#method_register", "name": "Klaviyo\\KlaviyoProvider::register", "doc": "&quot;{@inheritdoc}&quot;"},
            
            {"type": "Class", "fromName": "Klaviyo", "fromLink": "Klaviyo.html", "link": "Klaviyo/ListService.html", "name": "Klaviyo\\ListService", "doc": "&quot;The list manager class used to handle lists.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\ListService", "fromLink": "Klaviyo/ListService.html", "link": "Klaviyo/ListService.html#method_getList", "name": "Klaviyo\\ListService::getList", "doc": "&quot;Retrieve a specific list from Klaviyo.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\ListService", "fromLink": "Klaviyo/ListService.html", "link": "Klaviyo/ListService.html#method_getAllLists", "name": "Klaviyo\\ListService::getAllLists", "doc": "&quot;Retrieve all lists from Klaviyo.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\ListService", "fromLink": "Klaviyo/ListService.html", "link": "Klaviyo/ListService.html#method_getListsFromPage", "name": "Klaviyo\\ListService::getListsFromPage", "doc": "&quot;Get lists from a specific page.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\ListService", "fromLink": "Klaviyo/ListService.html", "link": "Klaviyo/ListService.html#method_createList", "name": "Klaviyo\\ListService::createList", "doc": "&quot;Create a new list.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\ListService", "fromLink": "Klaviyo/ListService.html", "link": "Klaviyo/ListService.html#method_updateList", "name": "Klaviyo\\ListService::updateList", "doc": "&quot;Update\/Modify an existing list.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\ListService", "fromLink": "Klaviyo/ListService.html", "link": "Klaviyo/ListService.html#method_deleteList", "name": "Klaviyo\\ListService::deleteList", "doc": "&quot;Delete an existing list.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\ListService", "fromLink": "Klaviyo/ListService.html", "link": "Klaviyo/ListService.html#method_checkMembersAreInList", "name": "Klaviyo\\ListService::checkMembersAreInList", "doc": "&quot;Check if the specified members are in the list by email address.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\ListService", "fromLink": "Klaviyo/ListService.html", "link": "Klaviyo/ListService.html#method_checkMembersAreInSegment", "name": "Klaviyo\\ListService::checkMembersAreInSegment", "doc": "&quot;Check if the specified members are in the segment by email address.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\ListService", "fromLink": "Klaviyo/ListService.html", "link": "Klaviyo/ListService.html#method_addPersonToList", "name": "Klaviyo\\ListService::addPersonToList", "doc": "&quot;Add a person to an existing List.&quot;"},
            
            {"type": "Class", "fromName": "Klaviyo\\Model", "fromLink": "Klaviyo/Model.html", "link": "Klaviyo/Model/BaseModel.html", "name": "Klaviyo\\Model\\BaseModel", "doc": "&quot;The base Klaviyo data model.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\Model\\BaseModel", "fromLink": "Klaviyo/Model/BaseModel.html", "link": "Klaviyo/Model/BaseModel.html#method___construct", "name": "Klaviyo\\Model\\BaseModel::__construct", "doc": "&quot;The constructor of a Klaviyo data model.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\BaseModel", "fromLink": "Klaviyo/Model/BaseModel.html", "link": "Klaviyo/Model/BaseModel.html#method___get", "name": "Klaviyo\\Model\\BaseModel::__get", "doc": "&quot;PHPs magic get method to provide access to our protected attributes.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\BaseModel", "fromLink": "Klaviyo/Model/BaseModel.html", "link": "Klaviyo/Model/BaseModel.html#method___set", "name": "Klaviyo\\Model\\BaseModel::__set", "doc": "&quot;PHPs magic set method to provide access to our mutable attributes.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\BaseModel", "fromLink": "Klaviyo/Model/BaseModel.html", "link": "Klaviyo/Model/BaseModel.html#method_create", "name": "Klaviyo\\Model\\BaseModel::create", "doc": "&quot;Helper method to create the data model.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\BaseModel", "fromLink": "Klaviyo/Model/BaseModel.html", "link": "Klaviyo/Model/BaseModel.html#method_createFromJson", "name": "Klaviyo\\Model\\BaseModel::createFromJson", "doc": "&quot;Helper method to create the data model from a JSON array.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\BaseModel", "fromLink": "Klaviyo/Model/BaseModel.html", "link": "Klaviyo/Model/BaseModel.html#method_jsonSerialize", "name": "Klaviyo\\Model\\BaseModel::jsonSerialize", "doc": "&quot;{@inheritdoc}&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\BaseModel", "fromLink": "Klaviyo/Model/BaseModel.html", "link": "Klaviyo/Model/BaseModel.html#method_toArray", "name": "Klaviyo\\Model\\BaseModel::toArray", "doc": "&quot;Convert the model to an array.&quot;"},
            
            {"type": "Class", "fromName": "Klaviyo\\Model", "fromLink": "Klaviyo/Model.html", "link": "Klaviyo/Model/EmptyModel.html", "name": "Klaviyo\\Model\\EmptyModel", "doc": "&quot;The empty Klaviyo data model.&quot;"},
                    
            {"type": "Class", "fromName": "Klaviyo\\Model", "fromLink": "Klaviyo/Model.html", "link": "Klaviyo/Model/ListModel.html", "name": "Klaviyo\\Model\\ListModel", "doc": "&quot;Simple model for a Klaviyo \&quot;List\&quot;.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\Model\\ListModel", "fromLink": "Klaviyo/Model/ListModel.html", "link": "Klaviyo/Model/ListModel.html#method___construct", "name": "Klaviyo\\Model\\ListModel::__construct", "doc": "&quot;The constructor of a Klaviyo data model.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\ListModel", "fromLink": "Klaviyo/Model/ListModel.html", "link": "Klaviyo/Model/ListModel.html#method_jsonSerialize", "name": "Klaviyo\\Model\\ListModel::jsonSerialize", "doc": "&quot;{@inheritdoc}&quot;"},
            
            {"type": "Class", "fromName": "Klaviyo\\Model", "fromLink": "Klaviyo/Model.html", "link": "Klaviyo/Model/ListReferenceModel.html", "name": "Klaviyo\\Model\\ListReferenceModel", "doc": "&quot;Simple model for a Klaviyo \&quot;List\&quot; reference.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\Model\\ListReferenceModel", "fromLink": "Klaviyo/Model/ListReferenceModel.html", "link": "Klaviyo/Model/ListReferenceModel.html#method___construct", "name": "Klaviyo\\Model\\ListReferenceModel::__construct", "doc": "&quot;The constructor of a Klaviyo data model.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\ListReferenceModel", "fromLink": "Klaviyo/Model/ListReferenceModel.html", "link": "Klaviyo/Model/ListReferenceModel.html#method_jsonSerialize", "name": "Klaviyo\\Model\\ListReferenceModel::jsonSerialize", "doc": "&quot;{@inheritdoc}&quot;"},
            
            {"type": "Class", "fromName": "Klaviyo\\Model", "fromLink": "Klaviyo/Model.html", "link": "Klaviyo/Model/MembershipModel.html", "name": "Klaviyo\\Model\\MembershipModel", "doc": "&quot;Simple model for a Klaviyo \&quot;Membership\&quot;.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\Model\\MembershipModel", "fromLink": "Klaviyo/Model/MembershipModel.html", "link": "Klaviyo/Model/MembershipModel.html#method___construct", "name": "Klaviyo\\Model\\MembershipModel::__construct", "doc": "&quot;The constructor of a Klaviyo data model.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\MembershipModel", "fromLink": "Klaviyo/Model/MembershipModel.html", "link": "Klaviyo/Model/MembershipModel.html#method_jsonSerialize", "name": "Klaviyo\\Model\\MembershipModel::jsonSerialize", "doc": "&quot;{@inheritdoc}&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\MembershipModel", "fromLink": "Klaviyo/Model/MembershipModel.html", "link": "Klaviyo/Model/MembershipModel.html#method_toArray", "name": "Klaviyo\\Model\\MembershipModel::toArray", "doc": "&quot;Convert the model to an array.&quot;"},
            
            {"type": "Class", "fromName": "Klaviyo\\Model", "fromLink": "Klaviyo/Model.html", "link": "Klaviyo/Model/ModelFactory.html", "name": "Klaviyo\\Model\\ModelFactory", "doc": "&quot;Model creation factory.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\Model\\ModelFactory", "fromLink": "Klaviyo/Model/ModelFactory.html", "link": "Klaviyo/Model/ModelFactory.html#method_getModelMap", "name": "Klaviyo\\Model\\ModelFactory::getModelMap", "doc": "&quot;Retrieve the model map.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\ModelFactory", "fromLink": "Klaviyo/Model/ModelFactory.html", "link": "Klaviyo/Model/ModelFactory.html#method_create", "name": "Klaviyo\\Model\\ModelFactory::create", "doc": "&quot;Create a new model.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\ModelFactory", "fromLink": "Klaviyo/Model/ModelFactory.html", "link": "Klaviyo/Model/ModelFactory.html#method_createFromJson", "name": "Klaviyo\\Model\\ModelFactory::createFromJson", "doc": "&quot;Create a new model from JSON.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\ModelFactory", "fromLink": "Klaviyo/Model/ModelFactory.html", "link": "Klaviyo/Model/ModelFactory.html#method_callModelCreationMethod", "name": "Klaviyo\\Model\\ModelFactory::callModelCreationMethod", "doc": "&quot;Create a new model from using the specified method.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\ModelFactory", "fromLink": "Klaviyo/Model/ModelFactory.html", "link": "Klaviyo/Model/ModelFactory.html#method_getModelType", "name": "Klaviyo\\Model\\ModelFactory::getModelType", "doc": "&quot;Get the model type.&quot;"},
            
            {"type": "Class", "fromName": "Klaviyo\\Model", "fromLink": "Klaviyo/Model.html", "link": "Klaviyo/Model/ModelInterface.html", "name": "Klaviyo\\Model\\ModelInterface", "doc": "&quot;The base Klaviyo data model.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\Model\\ModelInterface", "fromLink": "Klaviyo/Model/ModelInterface.html", "link": "Klaviyo/Model/ModelInterface.html#method_create", "name": "Klaviyo\\Model\\ModelInterface::create", "doc": "&quot;Helper method to create the data model.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\ModelInterface", "fromLink": "Klaviyo/Model/ModelInterface.html", "link": "Klaviyo/Model/ModelInterface.html#method_createFromJson", "name": "Klaviyo\\Model\\ModelInterface::createFromJson", "doc": "&quot;Helper method to create the data model from a JSON array.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\ModelInterface", "fromLink": "Klaviyo/Model/ModelInterface.html", "link": "Klaviyo/Model/ModelInterface.html#method_toArray", "name": "Klaviyo\\Model\\ModelInterface::toArray", "doc": "&quot;Convert the model to an array.&quot;"},
            
            {"type": "Class", "fromName": "Klaviyo\\Model", "fromLink": "Klaviyo/Model.html", "link": "Klaviyo/Model/PageModel.html", "name": "Klaviyo\\Model\\PageModel", "doc": "&quot;Simple model that represents a page.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\Model\\PageModel", "fromLink": "Klaviyo/Model/PageModel.html", "link": "Klaviyo/Model/PageModel.html#method___construct", "name": "Klaviyo\\Model\\PageModel::__construct", "doc": "&quot;The configuration to use to populate the Page model.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\PageModel", "fromLink": "Klaviyo/Model/PageModel.html", "link": "Klaviyo/Model/PageModel.html#method_jsonSerialize", "name": "Klaviyo\\Model\\PageModel::jsonSerialize", "doc": "&quot;{@inheritdoc}&quot;"},
            
            {"type": "Class", "fromName": "Klaviyo\\Model", "fromLink": "Klaviyo/Model.html", "link": "Klaviyo/Model/PersonListModel.html", "name": "Klaviyo\\Model\\PersonListModel", "doc": "&quot;Simple model for a Klaviyo \&quot;Person and List\&quot;.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\Model\\PersonListModel", "fromLink": "Klaviyo/Model/PersonListModel.html", "link": "Klaviyo/Model/PersonListModel.html#method___construct", "name": "Klaviyo\\Model\\PersonListModel::__construct", "doc": "&quot;The constructor of a Klaviyo data model.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\PersonListModel", "fromLink": "Klaviyo/Model/PersonListModel.html", "link": "Klaviyo/Model/PersonListModel.html#method_jsonSerialize", "name": "Klaviyo\\Model\\PersonListModel::jsonSerialize", "doc": "&quot;{@inheritdoc}&quot;"},
            
            {"type": "Class", "fromName": "Klaviyo\\Model", "fromLink": "Klaviyo/Model.html", "link": "Klaviyo/Model/PersonModel.html", "name": "Klaviyo\\Model\\PersonModel", "doc": "&quot;Simple model for a Klaviyo \&quot;Person\&quot;.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\Model\\PersonModel", "fromLink": "Klaviyo/Model/PersonModel.html", "link": "Klaviyo/Model/PersonModel.html#method___construct", "name": "Klaviyo\\Model\\PersonModel::__construct", "doc": "&quot;The constructor of a Klaviyo data model.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\PersonModel", "fromLink": "Klaviyo/Model/PersonModel.html", "link": "Klaviyo/Model/PersonModel.html#method_createFromJson", "name": "Klaviyo\\Model\\PersonModel::createFromJson", "doc": "&quot;Helper method to create the data model from a JSON array.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\PersonModel", "fromLink": "Klaviyo/Model/PersonModel.html", "link": "Klaviyo/Model/PersonModel.html#method_updateFromArray", "name": "Klaviyo\\Model\\PersonModel::updateFromArray", "doc": "&quot;Update the person model from an array.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\PersonModel", "fromLink": "Klaviyo/Model/PersonModel.html", "link": "Klaviyo/Model/PersonModel.html#method_getAttributeKeys", "name": "Klaviyo\\Model\\PersonModel::getAttributeKeys", "doc": "&quot;Retrieve an array of all attribute keys.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\PersonModel", "fromLink": "Klaviyo/Model/PersonModel.html", "link": "Klaviyo/Model/PersonModel.html#method_isCustomAttributeKey", "name": "Klaviyo\\Model\\PersonModel::isCustomAttributeKey", "doc": "&quot;Determine if the attribute is a custom attribute.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\PersonModel", "fromLink": "Klaviyo/Model/PersonModel.html", "link": "Klaviyo/Model/PersonModel.html#method_isSpecialAttributeKey", "name": "Klaviyo\\Model\\PersonModel::isSpecialAttributeKey", "doc": "&quot;Determine if the attribute is a special attribute.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\PersonModel", "fromLink": "Klaviyo/Model/PersonModel.html", "link": "Klaviyo/Model/PersonModel.html#method_getCustomAttribute", "name": "Klaviyo\\Model\\PersonModel::getCustomAttribute", "doc": "&quot;Retrieve a custom attribute by its attribute key.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\PersonModel", "fromLink": "Klaviyo/Model/PersonModel.html", "link": "Klaviyo/Model/PersonModel.html#method_getAllCustomAttributes", "name": "Klaviyo\\Model\\PersonModel::getAllCustomAttributes", "doc": "&quot;Retrieve all custom attributes for the person.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\PersonModel", "fromLink": "Klaviyo/Model/PersonModel.html", "link": "Klaviyo/Model/PersonModel.html#method_deleteAttribute", "name": "Klaviyo\\Model\\PersonModel::deleteAttribute", "doc": "&quot;Delete an attribute from the person model.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\PersonModel", "fromLink": "Klaviyo/Model/PersonModel.html", "link": "Klaviyo/Model/PersonModel.html#method_getModelPropertyFromSpecialAttributeKey", "name": "Klaviyo\\Model\\PersonModel::getModelPropertyFromSpecialAttributeKey", "doc": "&quot;Retrieve the model property from the special attribute key.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\PersonModel", "fromLink": "Klaviyo/Model/PersonModel.html", "link": "Klaviyo/Model/PersonModel.html#method_jsonSerialize", "name": "Klaviyo\\Model\\PersonModel::jsonSerialize", "doc": "&quot;{@inheritdoc}&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\PersonModel", "fromLink": "Klaviyo/Model/PersonModel.html", "link": "Klaviyo/Model/PersonModel.html#method_toArray", "name": "Klaviyo\\Model\\PersonModel::toArray", "doc": "&quot;Convert the model to an array.&quot;"},
            
            {"type": "Class", "fromName": "Klaviyo\\Model", "fromLink": "Klaviyo/Model.html", "link": "Klaviyo/Model/PersonReferenceModel.html", "name": "Klaviyo\\Model\\PersonReferenceModel", "doc": "&quot;Simple model for a Klaviyo \&quot;Person\&quot; reference.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\Model\\PersonReferenceModel", "fromLink": "Klaviyo/Model/PersonReferenceModel.html", "link": "Klaviyo/Model/PersonReferenceModel.html#method___construct", "name": "Klaviyo\\Model\\PersonReferenceModel::__construct", "doc": "&quot;The constructor of a Klaviyo data model.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\Model\\PersonReferenceModel", "fromLink": "Klaviyo/Model/PersonReferenceModel.html", "link": "Klaviyo/Model/PersonReferenceModel.html#method_jsonSerialize", "name": "Klaviyo\\Model\\PersonReferenceModel::jsonSerialize", "doc": "&quot;{@inheritdoc}&quot;"},
            
            {"type": "Trait", "fromName": "Klaviyo", "fromLink": "Klaviyo.html", "link": "Klaviyo/PagerTrait.html", "name": "Klaviyo\\PagerTrait", "doc": "&quot;Trait for adding a pager to a class.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\PagerTrait", "fromLink": "Klaviyo/PagerTrait.html", "link": "Klaviyo/PagerTrait.html#method_getApi", "name": "Klaviyo\\PagerTrait::getApi", "doc": "&quot;Retrieve the KlaviyoApi service object.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\PagerTrait", "fromLink": "Klaviyo/PagerTrait.html", "link": "Klaviyo/PagerTrait.html#method_getAllRecords", "name": "Klaviyo\\PagerTrait::getAllRecords", "doc": "&quot;Reteive all records for the specified paginated resource.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\PagerTrait", "fromLink": "Klaviyo/PagerTrait.html", "link": "Klaviyo/PagerTrait.html#method_getRecordsFromSpecificPage", "name": "Klaviyo\\PagerTrait::getRecordsFromSpecificPage", "doc": "&quot;Retrieve the records from a specific page.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\PagerTrait", "fromLink": "Klaviyo/PagerTrait.html", "link": "Klaviyo/PagerTrait.html#method_getPage", "name": "Klaviyo\\PagerTrait::getPage", "doc": "&quot;Retrieve a specific page from Klaviyo.&quot;"},
            
            {"type": "Class", "fromName": "Klaviyo", "fromLink": "Klaviyo.html", "link": "Klaviyo/PersonService.html", "name": "Klaviyo\\PersonService", "doc": "&quot;The list manager class used to handle lists.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\PersonService", "fromLink": "Klaviyo/PersonService.html", "link": "Klaviyo/PersonService.html#method_getPerson", "name": "Klaviyo\\PersonService::getPerson", "doc": "&quot;Retrieve a person from the Klaviyo API.&quot;"},
            
            {"type": "Class", "fromName": "Klaviyo", "fromLink": "Klaviyo.html", "link": "Klaviyo/ServiceInterface.html", "name": "Klaviyo\\ServiceInterface", "doc": "&quot;The base manager class used handle models transmission to and from the API.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\ServiceInterface", "fromLink": "Klaviyo/ServiceInterface.html", "link": "Klaviyo/ServiceInterface.html#method_create", "name": "Klaviyo\\ServiceInterface::create", "doc": "&quot;Instantiates a new instance of this class.&quot;"},
                    {"type": "Method", "fromName": "Klaviyo\\ServiceInterface", "fromLink": "Klaviyo/ServiceInterface.html", "link": "Klaviyo/ServiceInterface.html#method_getResourcePath", "name": "Klaviyo\\ServiceInterface::getResourcePath", "doc": "&quot;Retrieve the full resource path.&quot;"},
            
            {"type": "Class", "fromName": "Klaviyo", "fromLink": "Klaviyo.html", "link": "Klaviyo/TrackService.html", "name": "Klaviyo\\TrackService", "doc": "&quot;The track manager class used to handle lists.&quot;"},
                                                        {"type": "Method", "fromName": "Klaviyo\\TrackService", "fromLink": "Klaviyo/TrackService.html", "link": "Klaviyo/TrackService.html#method_identify", "name": "Klaviyo\\TrackService::identify", "doc": "&quot;Identify a person to the Klaviyo API.&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


