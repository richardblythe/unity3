<?php

namespace Unity3_Vendor\Aws\GlobalAccelerator;

use Unity3_Vendor\Aws\AwsClient;
/**
 * This client is used to interact with the **AWS Global Accelerator** service.
 * @method \Aws\Result addCustomRoutingEndpoints(array $args = [])
 * @method \GuzzleHttp\Promise\Promise addCustomRoutingEndpointsAsync(array $args = [])
 * @method \Aws\Result advertiseByoipCidr(array $args = [])
 * @method \GuzzleHttp\Promise\Promise advertiseByoipCidrAsync(array $args = [])
 * @method \Aws\Result allowCustomRoutingTraffic(array $args = [])
 * @method \GuzzleHttp\Promise\Promise allowCustomRoutingTrafficAsync(array $args = [])
 * @method \Aws\Result createAccelerator(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createAcceleratorAsync(array $args = [])
 * @method \Aws\Result createCustomRoutingAccelerator(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createCustomRoutingAcceleratorAsync(array $args = [])
 * @method \Aws\Result createCustomRoutingEndpointGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createCustomRoutingEndpointGroupAsync(array $args = [])
 * @method \Aws\Result createCustomRoutingListener(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createCustomRoutingListenerAsync(array $args = [])
 * @method \Aws\Result createEndpointGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createEndpointGroupAsync(array $args = [])
 * @method \Aws\Result createListener(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createListenerAsync(array $args = [])
 * @method \Aws\Result deleteAccelerator(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteAcceleratorAsync(array $args = [])
 * @method \Aws\Result deleteCustomRoutingAccelerator(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteCustomRoutingAcceleratorAsync(array $args = [])
 * @method \Aws\Result deleteCustomRoutingEndpointGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteCustomRoutingEndpointGroupAsync(array $args = [])
 * @method \Aws\Result deleteCustomRoutingListener(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteCustomRoutingListenerAsync(array $args = [])
 * @method \Aws\Result deleteEndpointGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteEndpointGroupAsync(array $args = [])
 * @method \Aws\Result deleteListener(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteListenerAsync(array $args = [])
 * @method \Aws\Result denyCustomRoutingTraffic(array $args = [])
 * @method \GuzzleHttp\Promise\Promise denyCustomRoutingTrafficAsync(array $args = [])
 * @method \Aws\Result deprovisionByoipCidr(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deprovisionByoipCidrAsync(array $args = [])
 * @method \Aws\Result describeAccelerator(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeAcceleratorAsync(array $args = [])
 * @method \Aws\Result describeAcceleratorAttributes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeAcceleratorAttributesAsync(array $args = [])
 * @method \Aws\Result describeCustomRoutingAccelerator(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeCustomRoutingAcceleratorAsync(array $args = [])
 * @method \Aws\Result describeCustomRoutingAcceleratorAttributes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeCustomRoutingAcceleratorAttributesAsync(array $args = [])
 * @method \Aws\Result describeCustomRoutingEndpointGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeCustomRoutingEndpointGroupAsync(array $args = [])
 * @method \Aws\Result describeCustomRoutingListener(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeCustomRoutingListenerAsync(array $args = [])
 * @method \Aws\Result describeEndpointGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeEndpointGroupAsync(array $args = [])
 * @method \Aws\Result describeListener(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeListenerAsync(array $args = [])
 * @method \Aws\Result listAccelerators(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listAcceleratorsAsync(array $args = [])
 * @method \Aws\Result listByoipCidrs(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listByoipCidrsAsync(array $args = [])
 * @method \Aws\Result listCustomRoutingAccelerators(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listCustomRoutingAcceleratorsAsync(array $args = [])
 * @method \Aws\Result listCustomRoutingEndpointGroups(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listCustomRoutingEndpointGroupsAsync(array $args = [])
 * @method \Aws\Result listCustomRoutingListeners(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listCustomRoutingListenersAsync(array $args = [])
 * @method \Aws\Result listCustomRoutingPortMappings(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listCustomRoutingPortMappingsAsync(array $args = [])
 * @method \Aws\Result listCustomRoutingPortMappingsByDestination(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listCustomRoutingPortMappingsByDestinationAsync(array $args = [])
 * @method \Aws\Result listEndpointGroups(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listEndpointGroupsAsync(array $args = [])
 * @method \Aws\Result listListeners(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listListenersAsync(array $args = [])
 * @method \Aws\Result listTagsForResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listTagsForResourceAsync(array $args = [])
 * @method \Aws\Result provisionByoipCidr(array $args = [])
 * @method \GuzzleHttp\Promise\Promise provisionByoipCidrAsync(array $args = [])
 * @method \Aws\Result removeCustomRoutingEndpoints(array $args = [])
 * @method \GuzzleHttp\Promise\Promise removeCustomRoutingEndpointsAsync(array $args = [])
 * @method \Aws\Result tagResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise tagResourceAsync(array $args = [])
 * @method \Aws\Result untagResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise untagResourceAsync(array $args = [])
 * @method \Aws\Result updateAccelerator(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateAcceleratorAsync(array $args = [])
 * @method \Aws\Result updateAcceleratorAttributes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateAcceleratorAttributesAsync(array $args = [])
 * @method \Aws\Result updateCustomRoutingAccelerator(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateCustomRoutingAcceleratorAsync(array $args = [])
 * @method \Aws\Result updateCustomRoutingAcceleratorAttributes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateCustomRoutingAcceleratorAttributesAsync(array $args = [])
 * @method \Aws\Result updateCustomRoutingListener(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateCustomRoutingListenerAsync(array $args = [])
 * @method \Aws\Result updateEndpointGroup(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateEndpointGroupAsync(array $args = [])
 * @method \Aws\Result updateListener(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateListenerAsync(array $args = [])
 * @method \Aws\Result withdrawByoipCidr(array $args = [])
 * @method \GuzzleHttp\Promise\Promise withdrawByoipCidrAsync(array $args = [])
 */
class GlobalAcceleratorClient extends AwsClient
{
}
