<?xml version="1.0" encoding="UTF-8"?>

<process name="demo" xmlns="http://jbpm.org/4.4/jpdl">
   <start g="383,-4,48,48" name="start1">
      <transition g="-79,-22" name="to exclusive1" to="exclusive1"/>
   </start>
   <state g="495,422,9,5" name="state4"/>
   <decision g="385,75,48,48" name="exclusive1">
   <handler class="\Org\Jbmp\TestHander\testHander" />
      <transition g="-52,-22" name="to task1" to="task1"/>
   </decision>
   <task candidate-users="#{user1,user2}" g="385,163,92,52" name="task1">
      <transition g="-52,-22" name="to fork1" to="fork1"/>
   </task>
   <fork g="398,264,48,48" name="fork1">
      <transition g="-56,-22" name="to state1" to="state1"/>
      <transition g="-79,-22" name="to exclusive2" to="exclusive2"/>
   </fork>
   <state g="232,363,92,52" name="state1">
      <transition g="-49,-22" name="to join1" to="join1"/>
   </state>
   <decision g="553,277,48,48" name="exclusive2">
   <handler class="\Org\Jbmp\TestHander\test2Hander" />
      <transition g="-52,-22" name="to task2" to="task2"/>
      <transition g="-52,-22" name="to task3" to="task3"/>
   </decision>
   <task candidate-groups="#{team1}" g="425,455,92,52" name="task2">
      <transition g="-56,-22" name="to state2" to="state2"/>
   </task>
   <task candidate-users="#{user1}" g="544,455,92,52" name="task3">
      <transition g="-56,-22" name="to state2" to="state2"/>
   </task>
   <state g="473,543,92,52" name="state2">
      <transition g="-49,-22" name="to join1" to="join1"/>
   </state>
   <join g="294,543,48,48" name="join1">
      <transition g="-56,-22" name="to state3" to="state3"/>
   </join>
   <end g="379,730,48,48" name="end1"/>
   <state g="293,640,92,52" name="state3">
      <transition g="-50,-22" name="to end1" to="end1"/>
   </state>
</process>


20161127 join decision 没有写