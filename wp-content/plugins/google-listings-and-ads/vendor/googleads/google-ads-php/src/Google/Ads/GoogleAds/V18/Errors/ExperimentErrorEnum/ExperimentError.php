<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v18/errors/experiment_error.proto

namespace Google\Ads\GoogleAds\V18\Errors\ExperimentErrorEnum;

use UnexpectedValueException;

/**
 * Enum describing possible experiment errors.
 *
 * Protobuf type <code>google.ads.googleads.v18.errors.ExperimentErrorEnum.ExperimentError</code>
 */
class ExperimentError
{
    /**
     * Enum unspecified.
     *
     * Generated from protobuf enum <code>UNSPECIFIED = 0;</code>
     */
    const UNSPECIFIED = 0;
    /**
     * The received error code is not known in this version.
     *
     * Generated from protobuf enum <code>UNKNOWN = 1;</code>
     */
    const UNKNOWN = 1;
    /**
     * The start date of an experiment cannot be set in the past.
     * Use a start date in the future.
     *
     * Generated from protobuf enum <code>CANNOT_SET_START_DATE_IN_PAST = 2;</code>
     */
    const CANNOT_SET_START_DATE_IN_PAST = 2;
    /**
     * The end date of an experiment is before its start date.
     * Use an end date after the start date.
     *
     * Generated from protobuf enum <code>END_DATE_BEFORE_START_DATE = 3;</code>
     */
    const END_DATE_BEFORE_START_DATE = 3;
    /**
     * The start date of an experiment is too far in the future.
     * Use a start date no more than 1 year in the future.
     *
     * Generated from protobuf enum <code>START_DATE_TOO_FAR_IN_FUTURE = 4;</code>
     */
    const START_DATE_TOO_FAR_IN_FUTURE = 4;
    /**
     * The experiment has the same name as an existing active experiment.
     *
     * Generated from protobuf enum <code>DUPLICATE_EXPERIMENT_NAME = 5;</code>
     */
    const DUPLICATE_EXPERIMENT_NAME = 5;
    /**
     * Experiments can only be modified when they are ENABLED.
     *
     * Generated from protobuf enum <code>CANNOT_MODIFY_REMOVED_EXPERIMENT = 6;</code>
     */
    const CANNOT_MODIFY_REMOVED_EXPERIMENT = 6;
    /**
     * The start date of an experiment cannot be modified if the existing start
     * date has already passed.
     *
     * Generated from protobuf enum <code>START_DATE_ALREADY_PASSED = 7;</code>
     */
    const START_DATE_ALREADY_PASSED = 7;
    /**
     * The end date of an experiment cannot be set in the past.
     *
     * Generated from protobuf enum <code>CANNOT_SET_END_DATE_IN_PAST = 8;</code>
     */
    const CANNOT_SET_END_DATE_IN_PAST = 8;
    /**
     * The status of an experiment cannot be set to REMOVED.
     *
     * Generated from protobuf enum <code>CANNOT_SET_STATUS_TO_REMOVED = 9;</code>
     */
    const CANNOT_SET_STATUS_TO_REMOVED = 9;
    /**
     * The end date of an expired experiment cannot be modified.
     *
     * Generated from protobuf enum <code>CANNOT_MODIFY_PAST_END_DATE = 10;</code>
     */
    const CANNOT_MODIFY_PAST_END_DATE = 10;
    /**
     * The status is invalid.
     *
     * Generated from protobuf enum <code>INVALID_STATUS = 11;</code>
     */
    const INVALID_STATUS = 11;
    /**
     * Experiment arm contains campaigns with invalid advertising channel type.
     *
     * Generated from protobuf enum <code>INVALID_CAMPAIGN_CHANNEL_TYPE = 12;</code>
     */
    const INVALID_CAMPAIGN_CHANNEL_TYPE = 12;
    /**
     * A pair of trials share members and have overlapping date ranges.
     *
     * Generated from protobuf enum <code>OVERLAPPING_MEMBERS_AND_DATE_RANGE = 13;</code>
     */
    const OVERLAPPING_MEMBERS_AND_DATE_RANGE = 13;
    /**
     * Experiment arm contains invalid traffic split.
     *
     * Generated from protobuf enum <code>INVALID_TRIAL_ARM_TRAFFIC_SPLIT = 14;</code>
     */
    const INVALID_TRIAL_ARM_TRAFFIC_SPLIT = 14;
    /**
     * Experiment contains trial arms with overlapping traffic split.
     *
     * Generated from protobuf enum <code>TRAFFIC_SPLIT_OVERLAPPING = 15;</code>
     */
    const TRAFFIC_SPLIT_OVERLAPPING = 15;
    /**
     * The total traffic split of trial arms is not equal to 100.
     *
     * Generated from protobuf enum <code>SUM_TRIAL_ARM_TRAFFIC_UNEQUALS_TO_TRIAL_TRAFFIC_SPLIT_DENOMINATOR = 16;</code>
     */
    const SUM_TRIAL_ARM_TRAFFIC_UNEQUALS_TO_TRIAL_TRAFFIC_SPLIT_DENOMINATOR = 16;
    /**
     * Traffic split related settings (like traffic share bounds) can't be
     * modified after the experiment has started.
     *
     * Generated from protobuf enum <code>CANNOT_MODIFY_TRAFFIC_SPLIT_AFTER_START = 17;</code>
     */
    const CANNOT_MODIFY_TRAFFIC_SPLIT_AFTER_START = 17;
    /**
     * The experiment could not be found.
     *
     * Generated from protobuf enum <code>EXPERIMENT_NOT_FOUND = 18;</code>
     */
    const EXPERIMENT_NOT_FOUND = 18;
    /**
     * Experiment has not begun.
     *
     * Generated from protobuf enum <code>EXPERIMENT_NOT_YET_STARTED = 19;</code>
     */
    const EXPERIMENT_NOT_YET_STARTED = 19;
    /**
     * The experiment cannot have more than one control arm.
     *
     * Generated from protobuf enum <code>CANNOT_HAVE_MULTIPLE_CONTROL_ARMS = 20;</code>
     */
    const CANNOT_HAVE_MULTIPLE_CONTROL_ARMS = 20;
    /**
     * The experiment doesn't set in-design campaigns.
     *
     * Generated from protobuf enum <code>IN_DESIGN_CAMPAIGNS_NOT_SET = 21;</code>
     */
    const IN_DESIGN_CAMPAIGNS_NOT_SET = 21;
    /**
     * Clients must use the graduate action to graduate experiments and cannot
     * set the status to GRADUATED directly.
     *
     * Generated from protobuf enum <code>CANNOT_SET_STATUS_TO_GRADUATED = 22;</code>
     */
    const CANNOT_SET_STATUS_TO_GRADUATED = 22;
    /**
     * Cannot use shared budget on base campaign when scheduling an experiment.
     *
     * Generated from protobuf enum <code>CANNOT_CREATE_EXPERIMENT_CAMPAIGN_WITH_SHARED_BUDGET = 23;</code>
     */
    const CANNOT_CREATE_EXPERIMENT_CAMPAIGN_WITH_SHARED_BUDGET = 23;
    /**
     * Cannot use custom budget on base campaign when scheduling an experiment.
     *
     * Generated from protobuf enum <code>CANNOT_CREATE_EXPERIMENT_CAMPAIGN_WITH_CUSTOM_BUDGET = 24;</code>
     */
    const CANNOT_CREATE_EXPERIMENT_CAMPAIGN_WITH_CUSTOM_BUDGET = 24;
    /**
     * Invalid status transition.
     *
     * Generated from protobuf enum <code>STATUS_TRANSITION_INVALID = 25;</code>
     */
    const STATUS_TRANSITION_INVALID = 25;
    /**
     * The experiment campaign name conflicts with a pre-existing campaign.
     *
     * Generated from protobuf enum <code>DUPLICATE_EXPERIMENT_CAMPAIGN_NAME = 26;</code>
     */
    const DUPLICATE_EXPERIMENT_CAMPAIGN_NAME = 26;
    /**
     * Cannot remove in creation experiments.
     *
     * Generated from protobuf enum <code>CANNOT_REMOVE_IN_CREATION_EXPERIMENT = 27;</code>
     */
    const CANNOT_REMOVE_IN_CREATION_EXPERIMENT = 27;
    /**
     * Cannot add campaign with deprecated ad types. Deprecated ad types:
     * ENHANCED_DISPLAY, GALLERY, GMAIL, KEYWORDLESS, TEXT.
     *
     * Generated from protobuf enum <code>CANNOT_ADD_CAMPAIGN_WITH_DEPRECATED_AD_TYPES = 28;</code>
     */
    const CANNOT_ADD_CAMPAIGN_WITH_DEPRECATED_AD_TYPES = 28;
    /**
     * Sync can only be enabled for supported experiment types. Supported
     * experiment types: SEARCH_CUSTOM, DISPLAY_CUSTOM,
     * DISPLAY_AUTOMATED_BIDDING_STRATEGY, SEARCH_AUTOMATED_BIDDING_STRATEGY.
     *
     * Generated from protobuf enum <code>CANNOT_ENABLE_SYNC_FOR_UNSUPPORTED_EXPERIMENT_TYPE = 29;</code>
     */
    const CANNOT_ENABLE_SYNC_FOR_UNSUPPORTED_EXPERIMENT_TYPE = 29;
    /**
     * Experiment length cannot be longer than max length.
     *
     * Generated from protobuf enum <code>INVALID_DURATION_FOR_AN_EXPERIMENT = 30;</code>
     */
    const INVALID_DURATION_FOR_AN_EXPERIMENT = 30;

    private static $valueToName = [
        self::UNSPECIFIED => 'UNSPECIFIED',
        self::UNKNOWN => 'UNKNOWN',
        self::CANNOT_SET_START_DATE_IN_PAST => 'CANNOT_SET_START_DATE_IN_PAST',
        self::END_DATE_BEFORE_START_DATE => 'END_DATE_BEFORE_START_DATE',
        self::START_DATE_TOO_FAR_IN_FUTURE => 'START_DATE_TOO_FAR_IN_FUTURE',
        self::DUPLICATE_EXPERIMENT_NAME => 'DUPLICATE_EXPERIMENT_NAME',
        self::CANNOT_MODIFY_REMOVED_EXPERIMENT => 'CANNOT_MODIFY_REMOVED_EXPERIMENT',
        self::START_DATE_ALREADY_PASSED => 'START_DATE_ALREADY_PASSED',
        self::CANNOT_SET_END_DATE_IN_PAST => 'CANNOT_SET_END_DATE_IN_PAST',
        self::CANNOT_SET_STATUS_TO_REMOVED => 'CANNOT_SET_STATUS_TO_REMOVED',
        self::CANNOT_MODIFY_PAST_END_DATE => 'CANNOT_MODIFY_PAST_END_DATE',
        self::INVALID_STATUS => 'INVALID_STATUS',
        self::INVALID_CAMPAIGN_CHANNEL_TYPE => 'INVALID_CAMPAIGN_CHANNEL_TYPE',
        self::OVERLAPPING_MEMBERS_AND_DATE_RANGE => 'OVERLAPPING_MEMBERS_AND_DATE_RANGE',
        self::INVALID_TRIAL_ARM_TRAFFIC_SPLIT => 'INVALID_TRIAL_ARM_TRAFFIC_SPLIT',
        self::TRAFFIC_SPLIT_OVERLAPPING => 'TRAFFIC_SPLIT_OVERLAPPING',
        self::SUM_TRIAL_ARM_TRAFFIC_UNEQUALS_TO_TRIAL_TRAFFIC_SPLIT_DENOMINATOR => 'SUM_TRIAL_ARM_TRAFFIC_UNEQUALS_TO_TRIAL_TRAFFIC_SPLIT_DENOMINATOR',
        self::CANNOT_MODIFY_TRAFFIC_SPLIT_AFTER_START => 'CANNOT_MODIFY_TRAFFIC_SPLIT_AFTER_START',
        self::EXPERIMENT_NOT_FOUND => 'EXPERIMENT_NOT_FOUND',
        self::EXPERIMENT_NOT_YET_STARTED => 'EXPERIMENT_NOT_YET_STARTED',
        self::CANNOT_HAVE_MULTIPLE_CONTROL_ARMS => 'CANNOT_HAVE_MULTIPLE_CONTROL_ARMS',
        self::IN_DESIGN_CAMPAIGNS_NOT_SET => 'IN_DESIGN_CAMPAIGNS_NOT_SET',
        self::CANNOT_SET_STATUS_TO_GRADUATED => 'CANNOT_SET_STATUS_TO_GRADUATED',
        self::CANNOT_CREATE_EXPERIMENT_CAMPAIGN_WITH_SHARED_BUDGET => 'CANNOT_CREATE_EXPERIMENT_CAMPAIGN_WITH_SHARED_BUDGET',
        self::CANNOT_CREATE_EXPERIMENT_CAMPAIGN_WITH_CUSTOM_BUDGET => 'CANNOT_CREATE_EXPERIMENT_CAMPAIGN_WITH_CUSTOM_BUDGET',
        self::STATUS_TRANSITION_INVALID => 'STATUS_TRANSITION_INVALID',
        self::DUPLICATE_EXPERIMENT_CAMPAIGN_NAME => 'DUPLICATE_EXPERIMENT_CAMPAIGN_NAME',
        self::CANNOT_REMOVE_IN_CREATION_EXPERIMENT => 'CANNOT_REMOVE_IN_CREATION_EXPERIMENT',
        self::CANNOT_ADD_CAMPAIGN_WITH_DEPRECATED_AD_TYPES => 'CANNOT_ADD_CAMPAIGN_WITH_DEPRECATED_AD_TYPES',
        self::CANNOT_ENABLE_SYNC_FOR_UNSUPPORTED_EXPERIMENT_TYPE => 'CANNOT_ENABLE_SYNC_FOR_UNSUPPORTED_EXPERIMENT_TYPE',
        self::INVALID_DURATION_FOR_AN_EXPERIMENT => 'INVALID_DURATION_FOR_AN_EXPERIMENT',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ExperimentError::class, \Google\Ads\GoogleAds\V18\Errors\ExperimentErrorEnum_ExperimentError::class);

