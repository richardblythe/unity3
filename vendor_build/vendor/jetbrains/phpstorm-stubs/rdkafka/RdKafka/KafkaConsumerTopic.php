<?php

namespace Unity3_Vendor\RdKafka;

class KafkaConsumerTopic extends Topic
{
    /**
     * @param int $partition
     * @param int $offset
     *
     * @return void
     */
    public function offsetStore($partition, $offset)
    {
    }
}
