<?php

namespace Unity3_Vendor;

const RD_KAFKA_RESP_ERR__BEGIN = -200;
const RD_KAFKA_RESP_ERR__BAD_MSG = -199;
const RD_KAFKA_RESP_ERR__BAD_COMPRESSION = -198;
const RD_KAFKA_RESP_ERR__DESTROY = -197;
const RD_KAFKA_RESP_ERR__FAIL = -196;
const RD_KAFKA_RESP_ERR__TRANSPORT = -195;
const RD_KAFKA_RESP_ERR__CRIT_SYS_RESOURCE = -194;
const RD_KAFKA_RESP_ERR__RESOLVE = -193;
const RD_KAFKA_RESP_ERR__MSG_TIMED_OUT = -192;
const RD_KAFKA_RESP_ERR__PARTITION_EOF = -191;
const RD_KAFKA_RESP_ERR__UNKNOWN_PARTITION = -190;
const RD_KAFKA_RESP_ERR__FS = -189;
const RD_KAFKA_RESP_ERR__UNKNOWN_TOPIC = -188;
const RD_KAFKA_RESP_ERR__ALL_BROKERS_DOWN = -187;
const RD_KAFKA_RESP_ERR__INVALID_ARG = -186;
const RD_KAFKA_RESP_ERR__TIMED_OUT = -185;
const RD_KAFKA_RESP_ERR__QUEUE_FULL = -184;
const RD_KAFKA_RESP_ERR__ISR_INSUFF = -183;
const RD_KAFKA_RESP_ERR__NODE_UPDATE = -182;
const RD_KAFKA_RESP_ERR__SSL = -181;
const RD_KAFKA_RESP_ERR__WAIT_COORD = -180;
const RD_KAFKA_RESP_ERR__UNKNOWN_GROUP = -179;
const RD_KAFKA_RESP_ERR__IN_PROGRESS = -178;
const RD_KAFKA_RESP_ERR__PREV_IN_PROGRESS = -177;
const RD_KAFKA_RESP_ERR__EXISTING_SUBSCRIPTION = -176;
const RD_KAFKA_RESP_ERR__ASSIGN_PARTITIONS = -175;
const RD_KAFKA_RESP_ERR__REVOKE_PARTITIONS = -174;
const RD_KAFKA_RESP_ERR__CONFLICT = -173;
const RD_KAFKA_RESP_ERR__STATE = -172;
const RD_KAFKA_RESP_ERR__UNKNOWN_PROTOCOL = -171;
const RD_KAFKA_RESP_ERR__NOT_IMPLEMENTED = -170;
const RD_KAFKA_RESP_ERR__AUTHENTICATION = -169;
const RD_KAFKA_RESP_ERR__NO_OFFSET = -168;
const RD_KAFKA_RESP_ERR__OUTDATED = -167;
const RD_KAFKA_RESP_ERR__TIMED_OUT_QUEUE = -166;
const RD_KAFKA_RESP_ERR__UNSUPPORTED_FEATURE = -165;
const RD_KAFKA_RESP_ERR__WAIT_CACHE = -164;
const RD_KAFKA_RESP_ERR__INTR = -163;
const RD_KAFKA_RESP_ERR__KEY_SERIALIZATION = -162;
const RD_KAFKA_RESP_ERR__VALUE_SERIALIZATION = -161;
const RD_KAFKA_RESP_ERR__KEY_DESERIALIZATION = -160;
const RD_KAFKA_RESP_ERR__VALUE_DESERIALIZATION = -159;
const RD_KAFKA_RESP_ERR__PARTIAL = -158;
const RD_KAFKA_RESP_ERR__END = -100;
const RD_KAFKA_RESP_ERR_UNKNOWN = -1;
const RD_KAFKA_RESP_ERR_NO_ERROR = 0;
const RD_KAFKA_RESP_ERR_OFFSET_OUT_OF_RANGE = 1;
const RD_KAFKA_RESP_ERR_INVALID_MSG = 2;
const RD_KAFKA_RESP_ERR_UNKNOWN_TOPIC_OR_PART = 3;
const RD_KAFKA_RESP_ERR_INVALID_MSG_SIZE = 4;
const RD_KAFKA_RESP_ERR_LEADER_NOT_AVAILABLE = 5;
const RD_KAFKA_RESP_ERR_NOT_LEADER_FOR_PARTITION = 6;
const RD_KAFKA_RESP_ERR_REQUEST_TIMED_OUT = 7;
const RD_KAFKA_RESP_ERR_BROKER_NOT_AVAILABLE = 8;
const RD_KAFKA_RESP_ERR_REPLICA_NOT_AVAILABLE = 9;
const RD_KAFKA_RESP_ERR_MSG_SIZE_TOO_LARGE = 10;
const RD_KAFKA_RESP_ERR_STALE_CTRL_EPOCH = 11;
const RD_KAFKA_RESP_ERR_OFFSET_METADATA_TOO_LARGE = 12;
const RD_KAFKA_RESP_ERR_NETWORK_EXCEPTION = 13;
const RD_KAFKA_RESP_ERR_GROUP_LOAD_IN_PROGRESS = 14;
const RD_KAFKA_RESP_ERR_GROUP_COORDINATOR_NOT_AVAILABLE = 15;
const RD_KAFKA_RESP_ERR_NOT_COORDINATOR_FOR_GROUP = 16;
const RD_KAFKA_RESP_ERR_TOPIC_EXCEPTION = 17;
const RD_KAFKA_RESP_ERR_RECORD_LIST_TOO_LARGE = 18;
const RD_KAFKA_RESP_ERR_NOT_ENOUGH_REPLICAS = 19;
const RD_KAFKA_RESP_ERR_NOT_ENOUGH_REPLICAS_AFTER_APPEND = 20;
const RD_KAFKA_RESP_ERR_INVALID_REQUIRED_ACKS = 21;
const RD_KAFKA_RESP_ERR_ILLEGAL_GENERATION = 22;
const RD_KAFKA_RESP_ERR_INCONSISTENT_GROUP_PROTOCOL = 23;
const RD_KAFKA_RESP_ERR_INVALID_GROUP_ID = 24;
const RD_KAFKA_RESP_ERR_UNKNOWN_MEMBER_ID = 25;
const RD_KAFKA_RESP_ERR_INVALID_SESSION_TIMEOUT = 26;
const RD_KAFKA_RESP_ERR_REBALANCE_IN_PROGRESS = 27;
const RD_KAFKA_RESP_ERR_INVALID_COMMIT_OFFSET_SIZE = 28;
const RD_KAFKA_RESP_ERR_TOPIC_AUTHORIZATION_FAILED = 29;
const RD_KAFKA_RESP_ERR_GROUP_AUTHORIZATION_FAILED = 30;
const RD_KAFKA_RESP_ERR_CLUSTER_AUTHORIZATION_FAILED = 31;
const RD_KAFKA_RESP_ERR_INVALID_TIMESTAMP = 32;
const RD_KAFKA_RESP_ERR_UNSUPPORTED_SASL_MECHANISM = 33;
const RD_KAFKA_RESP_ERR_ILLEGAL_SASL_STATE = 34;
const RD_KAFKA_RESP_ERR_UNSUPPORTED_VERSION = 35;
const RD_KAFKA_RESP_ERR_TOPIC_ALREADY_EXISTS = 36;
const RD_KAFKA_RESP_ERR_INVALID_PARTITIONS = 37;
const RD_KAFKA_RESP_ERR_INVALID_REPLICATION_FACTOR = 38;
const RD_KAFKA_RESP_ERR_INVALID_REPLICA_ASSIGNMENT = 39;
const RD_KAFKA_RESP_ERR_INVALID_CONFIG = 40;
const RD_KAFKA_RESP_ERR_NOT_CONTROLLER = 41;
const RD_KAFKA_RESP_ERR_INVALID_REQUEST = 42;
const RD_KAFKA_RESP_ERR_UNSUPPORTED_FOR_MESSAGE_FORMAT = 43;
const RD_KAFKA_RESP_ERR_POLICY_VIOLATION = 44;
const RD_KAFKA_RESP_ERR_OUT_OF_ORDER_SEQUENCE_NUMBER = 45;
const RD_KAFKA_RESP_ERR_DUPLICATE_SEQUENCE_NUMBER = 46;
const RD_KAFKA_RESP_ERR_INVALID_PRODUCER_EPOCH = 47;
const RD_KAFKA_RESP_ERR_INVALID_TXN_STATE = 48;
const RD_KAFKA_RESP_ERR_INVALID_PRODUCER_ID_MAPPING = 49;
const RD_KAFKA_RESP_ERR_INVALID_TRANSACTION_TIMEOUT = 50;
const RD_KAFKA_RESP_ERR_CONCURRENT_TRANSACTIONS = 51;
const RD_KAFKA_RESP_ERR_TRANSACTION_COORDINATOR_FENCED = 52;
const RD_KAFKA_RESP_ERR_TRANSACTIONAL_ID_AUTHORIZATION_FAILED = 53;
const RD_KAFKA_RESP_ERR_SECURITY_DISABLED = 54;
const RD_KAFKA_RESP_ERR_OPERATION_NOT_ATTEMPTED = 55;
const RD_KAFKA_RESP_ERR__READ_ONLY = -157;
const RD_KAFKA_RESP_ERR__NOENT = -156;
const RD_KAFKA_RESP_ERR__UNDERFLOW = -155;
const RD_KAFKA_RESP_ERR__INVALID_TYPE = -154;
const RD_KAFKA_CONSUMER = 1;
const RD_KAFKA_OFFSET_BEGINNING = -2;
const RD_KAFKA_OFFSET_END = -1;
const RD_KAFKA_OFFSET_STORED = -1000;
const RD_KAFKA_OFFSET_INVALID = -1001;
const RD_KAFKA_PARTITION_UA = -1;
const RD_KAFKA_PRODUCER = 0;
const RD_KAFKA_VERSION = 722687;
const RD_KAFKA_BUILD_VERSION = 722687;
const RD_KAFKA_CONF_UNKNOWN = -2;
const RD_KAFKA_CONF_INVALID = -1;
const RD_KAFKA_CONF_OK = 0;
const RD_KAFKA_MSG_PARTITIONER_RANDOM = 2;
const RD_KAFKA_MSG_PARTITIONER_CONSISTENT = 3;
const RD_KAFKA_LOG_PRINT = 100;
const RD_KAFKA_LOG_SYSLOG = 101;
const RD_KAFKA_LOG_SYSLOG_PRINT = 102;
