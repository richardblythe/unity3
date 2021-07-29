<?php

namespace Unity3_Vendor\Aws\GlueDataBrew;

use Unity3_Vendor\Aws\AwsClient;
/**
 * This client is used to interact with the **AWS Glue DataBrew** service.
 * @method \Aws\Result batchDeleteRecipeVersion(array $args = [])
 * @method \GuzzleHttp\Promise\Promise batchDeleteRecipeVersionAsync(array $args = [])
 * @method \Aws\Result createDataset(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createDatasetAsync(array $args = [])
 * @method \Aws\Result createProfileJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createProfileJobAsync(array $args = [])
 * @method \Aws\Result createProject(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createProjectAsync(array $args = [])
 * @method \Aws\Result createRecipe(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createRecipeAsync(array $args = [])
 * @method \Aws\Result createRecipeJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createRecipeJobAsync(array $args = [])
 * @method \Aws\Result createSchedule(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createScheduleAsync(array $args = [])
 * @method \Aws\Result deleteDataset(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteDatasetAsync(array $args = [])
 * @method \Aws\Result deleteJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteJobAsync(array $args = [])
 * @method \Aws\Result deleteProject(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteProjectAsync(array $args = [])
 * @method \Aws\Result deleteRecipeVersion(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteRecipeVersionAsync(array $args = [])
 * @method \Aws\Result deleteSchedule(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteScheduleAsync(array $args = [])
 * @method \Aws\Result describeDataset(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeDatasetAsync(array $args = [])
 * @method \Aws\Result describeJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeJobAsync(array $args = [])
 * @method \Aws\Result describeJobRun(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeJobRunAsync(array $args = [])
 * @method \Aws\Result describeProject(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeProjectAsync(array $args = [])
 * @method \Aws\Result describeRecipe(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeRecipeAsync(array $args = [])
 * @method \Aws\Result describeSchedule(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeScheduleAsync(array $args = [])
 * @method \Aws\Result listDatasets(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listDatasetsAsync(array $args = [])
 * @method \Aws\Result listJobRuns(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listJobRunsAsync(array $args = [])
 * @method \Aws\Result listJobs(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listJobsAsync(array $args = [])
 * @method \Aws\Result listProjects(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listProjectsAsync(array $args = [])
 * @method \Aws\Result listRecipeVersions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listRecipeVersionsAsync(array $args = [])
 * @method \Aws\Result listRecipes(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listRecipesAsync(array $args = [])
 * @method \Aws\Result listSchedules(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listSchedulesAsync(array $args = [])
 * @method \Aws\Result listTagsForResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listTagsForResourceAsync(array $args = [])
 * @method \Aws\Result publishRecipe(array $args = [])
 * @method \GuzzleHttp\Promise\Promise publishRecipeAsync(array $args = [])
 * @method \Aws\Result sendProjectSessionAction(array $args = [])
 * @method \GuzzleHttp\Promise\Promise sendProjectSessionActionAsync(array $args = [])
 * @method \Aws\Result startJobRun(array $args = [])
 * @method \GuzzleHttp\Promise\Promise startJobRunAsync(array $args = [])
 * @method \Aws\Result startProjectSession(array $args = [])
 * @method \GuzzleHttp\Promise\Promise startProjectSessionAsync(array $args = [])
 * @method \Aws\Result stopJobRun(array $args = [])
 * @method \GuzzleHttp\Promise\Promise stopJobRunAsync(array $args = [])
 * @method \Aws\Result tagResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise tagResourceAsync(array $args = [])
 * @method \Aws\Result untagResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise untagResourceAsync(array $args = [])
 * @method \Aws\Result updateDataset(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateDatasetAsync(array $args = [])
 * @method \Aws\Result updateProfileJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateProfileJobAsync(array $args = [])
 * @method \Aws\Result updateProject(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateProjectAsync(array $args = [])
 * @method \Aws\Result updateRecipe(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateRecipeAsync(array $args = [])
 * @method \Aws\Result updateRecipeJob(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateRecipeJobAsync(array $args = [])
 * @method \Aws\Result updateSchedule(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateScheduleAsync(array $args = [])
 */
class GlueDataBrewClient extends AwsClient
{
}