<?php

namespace Unity3_Vendor;

/**
 * Couchbase extension stubs
 * Gathered from https://docs.couchbase.com/sdk-api/couchbase-php-client-2.3.0/index.html
 * Maintainer: sergey@couchbase.com
 *
 * https://github.com/couchbase/php-couchbase/tree/master/api
 */
use function Unity3_Vendor\Couchbase\fastlzCompress as couchbase_fastlz_compress;
use function Unity3_Vendor\Couchbase\fastlzDecomress as couchbase_fastlz_decompress;
use function Unity3_Vendor\Couchbase\zlibCompress as couchbase_zlib_compress;
use function Unity3_Vendor\Couchbase\zlibDecomress as couchbase_zlib_decompress;
use function Unity3_Vendor\Couchbase\passthruEncoder as couchbase_passthru_encoder;
use function Unity3_Vendor\Couchbase\passthruDecoder as couchbase_passthru_decoder;
use function Unity3_Vendor\Couchbase\defaultEncoder as couchbase_default_encoder;
use function Unity3_Vendor\Couchbase\defaultDecoder as couchbase_default_decoder;
use function Unity3_Vendor\Couchbase\basicEncoderV1 as couchbase_basic_encoder_v1;
use function Unity3_Vendor\Couchbase\basicDecoderV1 as couchbase_basic_decoder_v1;
\class_alias("Couchbase\\Cluster", "Unity3_Vendor\\CouchbaseCluster");
\class_alias("Couchbase\\Bucket", "Unity3_Vendor\\CouchbaseBucket");
\class_alias("Couchbase\\MutationToken", "Unity3_Vendor\\CouchbaseMutationToken");
\class_alias("Couchbase\\MutationState", "Unity3_Vendor\\CouchbaseMutationState");
\class_alias("Couchbase\\BucketManager", "Unity3_Vendor\\CouchbaseBucketManager");
\class_alias("Couchbase\\ClusterManager", "Unity3_Vendor\\CouchbaseClusterManager");
\class_alias("Couchbase\\LookupInBuilder", "Unity3_Vendor\\CouchbaseLookupInBuilder");
\class_alias("Couchbase\\MutateInBuilder", "Unity3_Vendor\\CouchbaseMutateInBuilder");
\class_alias("Couchbase\\N1qlQuery", "Unity3_Vendor\\CouchbaseN1qlQuery");
\class_alias("Couchbase\\SearchQuery", "Unity3_Vendor\\CouchbaseSearchQuery");
\class_alias("Couchbase\\SearchQueryPart", "Unity3_Vendor\\CouchbaseAbstractSearchQuery");
\class_alias("Couchbase\\QueryStringSearchQuery", "Unity3_Vendor\\CouchbaseStringSearchQuery");
\class_alias("Couchbase\\MatchSearchQuery", "Unity3_Vendor\\CouchbaseMatchSearchQuery");
\class_alias("Couchbase\\MatchPhraseSearchQuery", "Unity3_Vendor\\CouchbaseMatchPhraseSearchQuery");
\class_alias("Couchbase\\PrefixSearchQuery", "Unity3_Vendor\\CouchbasePrefixSearchQuery");
\class_alias("Couchbase\\RegexpSearchQuery", "Unity3_Vendor\\CouchbaseRegexpSearchQuery");
\class_alias("Couchbase\\NumericRangeSearchQuery", "Unity3_Vendor\\CouchbaseNumericRangeSearchQuery");
\class_alias("Couchbase\\DisjunctionSearchQuery", "Unity3_Vendor\\CouchbaseDisjunctionSearchQuery");
\class_alias("Couchbase\\DateRangeSearchQuery", "Unity3_Vendor\\CouchbaseDateRangeSearchQuery");
\class_alias("Couchbase\\ConjunctionSearchQuery", "Unity3_Vendor\\CouchbaseConjunctionSearchQuery");
\class_alias("Couchbase\\BooleanSearchQuery", "Unity3_Vendor\\CouchbaseBooleanSearchQuery");
\class_alias("Couchbase\\WildcardSearchQuery", "Unity3_Vendor\\CouchbaseWildcardSearchQuery");
\class_alias("Couchbase\\DocIdSearchQuery", "Unity3_Vendor\\CouchbaseDocIdSearchQuery");
\class_alias("Couchbase\\BooleanFieldSearchQuery", "Unity3_Vendor\\CouchbaseBooleanFieldSearchQuery");
\class_alias("Couchbase\\TermSearchQuery", "Unity3_Vendor\\CouchbaseTermSearchQuery");
\class_alias("Couchbase\\PhraseSearchQuery", "Unity3_Vendor\\CouchbasePhraseSearchQuery");
\class_alias("Couchbase\\MatchAllSearchQuery", "Unity3_Vendor\\CouchbaseMatchAllSearchQuery");
\class_alias("Couchbase\\MatchNoneSearchQuery", "Unity3_Vendor\\CouchbaseMatchNoneSearchQuery");
\class_alias("Couchbase\\DateRangeSearchFacet", "Unity3_Vendor\\CouchbaseDateRangeSearchFacet");
\class_alias("Couchbase\\NumericRangeSearchFacet", "Unity3_Vendor\\CouchbaseNumericRangeSearchFacet");
\class_alias("Couchbase\\TermSearchFacet", "Unity3_Vendor\\CouchbaseTermSearchFacet");
\class_alias("Couchbase\\SearchFacet", "Unity3_Vendor\\CouchbaseSearchFacet");
\class_alias("Couchbase\\ViewQuery", "Unity3_Vendor\\CouchbaseViewQuery");
\class_alias("Couchbase\\DocumentFragment", "Unity3_Vendor\\CouchbaseDocumentFragment");
\class_alias("Couchbase\\Document", "Unity3_Vendor\\CouchbaseMetaDoc");
\class_alias("Couchbase\\Exception", "Unity3_Vendor\\CouchbaseException");
\class_alias("Couchbase\\ClassicAuthenticator", "Unity3_Vendor\\CouchbaseAuthenticator");
\define("COUCHBASE_PERSISTTO_MASTER", 1);
\define("COUCHBASE_PERSISTTO_ONE", 1);
\define("COUCHBASE_PERSISTTO_TWO", 2);
\define("COUCHBASE_PERSISTTO_THREE", 4);
\define("COUCHBASE_REPLICATETO_ONE", 16);
\define("COUCHBASE_REPLICATETO_TWO", 32);
\define("COUCHBASE_REPLICATETO_THREE", 64);
\define("COUCHBASE_SUCCESS", 0);
\define("COUCHBASE_AUTH_CONTINUE", 1);
\define("COUCHBASE_AUTH_ERROR", 2);
\define("COUCHBASE_DELTA_BADVAL", 3);
\define("COUCHBASE_E2BIG", 4);
\define("COUCHBASE_EBUSY", 5);
\define("COUCHBASE_EINTERNAL", 6);
\define("COUCHBASE_EINVAL", 7);
\define("COUCHBASE_ENOMEM", 8);
\define("COUCHBASE_ERANGE", 9);
\define("COUCHBASE_ERROR", 10);
\define("COUCHBASE_ETMPFAIL", 11);
\define("COUCHBASE_KEY_EEXISTS", 12);
\define("COUCHBASE_KEY_ENOENT", 13);
\define("COUCHBASE_DLOPEN_FAILED", 14);
\define("COUCHBASE_DLSYM_FAILED", 15);
\define("COUCHBASE_NETWORK_ERROR", 16);
\define("COUCHBASE_NOT_MY_VBUCKET", 17);
\define("COUCHBASE_NOT_STORED", 18);
\define("COUCHBASE_NOT_SUPPORTED", 19);
\define("COUCHBASE_UNKNOWN_COMMAND", 20);
\define("COUCHBASE_UNKNOWN_HOST", 21);
\define("COUCHBASE_PROTOCOL_ERROR", 22);
\define("COUCHBASE_ETIMEDOUT", 23);
\define("COUCHBASE_CONNECT_ERROR", 24);
\define("COUCHBASE_BUCKET_ENOENT", 25);
\define("COUCHBASE_CLIENT_ENOMEM", 26);
\define("COUCHBASE_CLIENT_ENOCONF", 27);
\define("COUCHBASE_EBADHANDLE", 28);
\define("COUCHBASE_SERVER_BUG", 29);
\define("COUCHBASE_PLUGIN_VERSION_MISMATCH", 30);
\define("COUCHBASE_INVALID_HOST_FORMAT", 31);
\define("COUCHBASE_INVALID_CHAR", 32);
\define("COUCHBASE_DURABILITY_ETOOMANY", 33);
\define("COUCHBASE_DUPLICATE_COMMANDS", 34);
\define("COUCHBASE_NO_MATCHING_SERVER", 35);
\define("COUCHBASE_BAD_ENVIRONMENT", 36);
\define("COUCHBASE_BUSY", 37);
\define("COUCHBASE_INVALID_USERNAME", 38);
\define("COUCHBASE_CONFIG_CACHE_INVALID", 39);
\define("COUCHBASE_SASLMECH_UNAVAILABLE", 40);
\define("COUCHBASE_TOO_MANY_REDIRECTS", 41);
\define("COUCHBASE_MAP_CHANGED", 42);
\define("COUCHBASE_INCOMPLETE_PACKET", 43);
\define("COUCHBASE_ECONNREFUSED", 44);
\define("COUCHBASE_ESOCKSHUTDOWN", 45);
\define("COUCHBASE_ECONNRESET", 46);
\define("COUCHBASE_ECANTGETPORT", 47);
\define("COUCHBASE_EFDLIMITREACHED", 48);
\define("COUCHBASE_ENETUNREACH", 49);
\define("COUCHBASE_ECTL_UNKNOWN", 50);
\define("COUCHBASE_ECTL_UNSUPPMODE", 51);
\define("COUCHBASE_ECTL_BADARG", 52);
\define("COUCHBASE_EMPTY_KEY", 53);
\define("COUCHBASE_SSL_ERROR", 54);
\define("COUCHBASE_SSL_CANTVERIFY", 55);
\define("COUCHBASE_SCHEDFAIL_INTERNAL", 56);
\define("COUCHBASE_CLIENT_FEATURE_UNAVAILABLE", 57);
\define("COUCHBASE_OPTIONS_CONFLICT", 58);
\define("COUCHBASE_HTTP_ERROR", 59);
\define("COUCHBASE_DURABILITY_NO_MUTATION_TOKENS", 60);
\define("COUCHBASE_UNKNOWN_MEMCACHED_ERROR", 61);
\define("COUCHBASE_MUTATION_LOST", 62);
\define("COUCHBASE_SUBDOC_PATH_ENOENT", 63);
\define("COUCHBASE_SUBDOC_PATH_MISMATCH", 64);
\define("COUCHBASE_SUBDOC_PATH_EINVAL", 65);
\define("COUCHBASE_SUBDOC_PATH_E2BIG", 66);
\define("COUCHBASE_SUBDOC_DOC_E2DEEP", 67);
\define("COUCHBASE_SUBDOC_VALUE_CANTINSERT", 68);
\define("COUCHBASE_SUBDOC_DOC_NOTJSON", 69);
\define("COUCHBASE_SUBDOC_NUM_ERANGE", 70);
\define("COUCHBASE_SUBDOC_BAD_DELTA", 71);
\define("COUCHBASE_SUBDOC_PATH_EEXISTS", 72);
\define("COUCHBASE_SUBDOC_MULTI_FAILURE", 73);
\define("COUCHBASE_SUBDOC_VALUE_E2DEEP", 74);
\define("COUCHBASE_EINVAL_MCD", 75);
\define("COUCHBASE_EMPTY_PATH", 76);
\define("COUCHBASE_UNKNOWN_SDCMD", 77);
\define("COUCHBASE_ENO_COMMANDS", 78);
\define("COUCHBASE_QUERY_ERROR", 79);
\define("COUCHBASE_TMPFAIL", 11);
\define("COUCHBASE_KEYALREADYEXISTS", 12);
\define("COUCHBASE_KEYNOTFOUND", 13);
