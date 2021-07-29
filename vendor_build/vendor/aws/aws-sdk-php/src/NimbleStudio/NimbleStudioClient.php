<?php

namespace Unity3_Vendor\Aws\NimbleStudio;

use Unity3_Vendor\Aws\AwsClient;
/**
 * This client is used to interact with the **AmazonNimbleStudio** service.
 * @method \Aws\Result acceptEulas(array $args = [])
 * @method \GuzzleHttp\Promise\Promise acceptEulasAsync(array $args = [])
 * @method \Aws\Result createLaunchProfile(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createLaunchProfileAsync(array $args = [])
 * @method \Aws\Result createStreamingImage(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createStreamingImageAsync(array $args = [])
 * @method \Aws\Result createStreamingSession(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createStreamingSessionAsync(array $args = [])
 * @method \Aws\Result createStreamingSessionStream(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createStreamingSessionStreamAsync(array $args = [])
 * @method \Aws\Result createStudio(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createStudioAsync(array $args = [])
 * @method \Aws\Result createStudioComponent(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createStudioComponentAsync(array $args = [])
 * @method \Aws\Result deleteLaunchProfile(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteLaunchProfileAsync(array $args = [])
 * @method \Aws\Result deleteLaunchProfileMember(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteLaunchProfileMemberAsync(array $args = [])
 * @method \Aws\Result deleteStreamingImage(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteStreamingImageAsync(array $args = [])
 * @method \Aws\Result deleteStreamingSession(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteStreamingSessionAsync(array $args = [])
 * @method \Aws\Result deleteStudio(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteStudioAsync(array $args = [])
 * @method \Aws\Result deleteStudioComponent(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteStudioComponentAsync(array $args = [])
 * @method \Aws\Result deleteStudioMember(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteStudioMemberAsync(array $args = [])
 * @method \Aws\Result getEula(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getEulaAsync(array $args = [])
 * @method \Aws\Result getLaunchProfile(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getLaunchProfileAsync(array $args = [])
 * @method \Aws\Result getLaunchProfileDetails(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getLaunchProfileDetailsAsync(array $args = [])
 * @method \Aws\Result getLaunchProfileInitialization(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getLaunchProfileInitializationAsync(array $args = [])
 * @method \Aws\Result getLaunchProfileMember(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getLaunchProfileMemberAsync(array $args = [])
 * @method \Aws\Result getStreamingImage(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getStreamingImageAsync(array $args = [])
 * @method \Aws\Result getStreamingSession(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getStreamingSessionAsync(array $args = [])
 * @method \Aws\Result getStreamingSessionStream(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getStreamingSessionStreamAsync(array $args = [])
 * @method \Aws\Result getStudio(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getStudioAsync(array $args = [])
 * @method \Aws\Result getStudioComponent(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getStudioComponentAsync(array $args = [])
 * @method \Aws\Result getStudioMember(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getStudioMemberAsync(array $args = [])
 * @method \Aws\Result listEulaAcceptances(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listEulaAcceptancesAsync(array $args = [])
 * @method \Aws\Result listEulas(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listEulasAsync(array $args = [])
 * @method \Aws\Result listLaunchProfileMembers(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listLaunchProfileMembersAsync(array $args = [])
 * @method \Aws\Result listLaunchProfiles(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listLaunchProfilesAsync(array $args = [])
 * @method \Aws\Result listStreamingImages(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listStreamingImagesAsync(array $args = [])
 * @method \Aws\Result listStreamingSessions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listStreamingSessionsAsync(array $args = [])
 * @method \Aws\Result listStudioComponents(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listStudioComponentsAsync(array $args = [])
 * @method \Aws\Result listStudioMembers(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listStudioMembersAsync(array $args = [])
 * @method \Aws\Result listStudios(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listStudiosAsync(array $args = [])
 * @method \Aws\Result listTagsForResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listTagsForResourceAsync(array $args = [])
 * @method \Aws\Result putLaunchProfileMembers(array $args = [])
 * @method \GuzzleHttp\Promise\Promise putLaunchProfileMembersAsync(array $args = [])
 * @method \Aws\Result putStudioMembers(array $args = [])
 * @method \GuzzleHttp\Promise\Promise putStudioMembersAsync(array $args = [])
 * @method \Aws\Result startStudioSSOConfigurationRepair(array $args = [])
 * @method \GuzzleHttp\Promise\Promise startStudioSSOConfigurationRepairAsync(array $args = [])
 * @method \Aws\Result tagResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise tagResourceAsync(array $args = [])
 * @method \Aws\Result untagResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise untagResourceAsync(array $args = [])
 * @method \Aws\Result updateLaunchProfile(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateLaunchProfileAsync(array $args = [])
 * @method \Aws\Result updateLaunchProfileMember(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateLaunchProfileMemberAsync(array $args = [])
 * @method \Aws\Result updateStreamingImage(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateStreamingImageAsync(array $args = [])
 * @method \Aws\Result updateStudio(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateStudioAsync(array $args = [])
 * @method \Aws\Result updateStudioComponent(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateStudioComponentAsync(array $args = [])
 */
class NimbleStudioClient extends AwsClient
{
}
